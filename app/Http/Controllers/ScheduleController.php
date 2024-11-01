<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\JobVacancy;
use App\Models\Application;
use App\Models\ScheduleLine;
use Illuminate\Http\Request;
use App\Http\Requests\ScheduleStoreRequest;
use App\Http\Requests\ScheduleUpdateRequest;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $schedules = Schedule::query(); // Inisialisasi query

        if ($request->has('search')) {
            $query = $request->search;
        
            // Tambahkan pencarian pada kolom 'name', 'email', dan 'position name'
            $schedules->where(function ($q) use ($query) {
                $q->whereHas('job', function ($q) use ($query) {
                    // Pencarian pada kolom 'code' dan 'start_time' di tabel 'job'
                    $q->where('code', 'like', "%{$query}%")
                      ->orWhere('start_time', 'like', "%{$query}%")
                      ->orWhereHas('position', function ($q) use ($query) {
                          // Pencarian pada kolom 'name' di tabel 'position'
                          $q->where('name', 'like', "%{$query}%");
                      });
                });
            });
        }
        $schedules = $schedules->paginate(10);
        // if ($request->has('search')) {
        //     $query = $request->search;
        //     // Tambahkan pencarian pada kolom 'code' dan 'name'
        //     $schedules = $schedules->where(function ($q) use ($query) {
        //         $q->where('code', 'like', "%{$query}%")
        //         ->orWhere('name', 'like', "%{$query}%");
        //     });
        // }

        return view('backend.schedule.index',[
            'schedules' => $schedules,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jobs = JobVacancy::where('status', 'Active')->with('position')->get();
        return view('backend.schedule.create',[
            'jobs' => $jobs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ScheduleStoreRequest $request)
    {
        $data = $request->validated();

        // Validasi untuk memastikan end_time lebih besar dari start_time
        if ($data['end_time'] <= $data['start_time']) {
            return redirect()->back()->withErrors('End time must be greater than start time')->withInput();
        }

        // Validasi untuk memastikan tanggal tidak kurang dari hari ini
        $dateNow = now()->startOfDay(); // Mendapatkan tanggal hari ini
        $selectedDate = \Carbon\Carbon::parse($data['date']); // Mengubah input tanggal ke Carbon

        if ($selectedDate < $dateNow) {
            return redirect()->back()->withErrors('The date cannot be less than today.')->withInput();
        }

        // Validasi untuk memastikan jam minimal adalah 2 jam dari sekarang
        $minStartTime = now()->addHours(2); // Mendapatkan waktu 2 jam dari sekarang

        // Pastikan start_time tidak kurang dari 2 jam dari sekarang pada tanggal yang sama
        if ($selectedDate->isToday() && $data['start_time'] < $minStartTime->toTimeString()) {
            return redirect()->back()->withErrors('The start time must be at least 2 hours from now.')->withInput();
        }

        Schedule::create($data);
        return redirect()->route('schedule.index')->with('success','Schedule has been created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        $applicants = $schedule->job->application()->where('status', 'interview')->where('is_interview',false)->get();
        return view('backend.schedule.show',[
            'schedule' => $schedule,
            'applicants' => $applicants,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        $jobs = JobVacancy::where('status', 'Active')->with('position')->get();

        return view('backend.schedule.edit',[
            'jobs' => $jobs,
            'schedule' => $schedule,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ScheduleUpdateRequest $request, Schedule $schedule)
    {
        $data = $request->validated();
        $schedule->update($data);
        return redirect()->route('schedule.show',$schedule)->with('success','Schedule has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        if ($schedule->status != 'Draft' && $schedule->status != 'Cancelled') {
            return redirect()->back()->with('error', 'You can only delete draft or cancelled schedules.');
        }
        $schedule->delete();
        return redirect()->route('schedule.index')->with('success', 'Schedule has been deleted successfully.');
    }

    public function generate_applicant(Request $request, $id)
    {
        $schedule = Schedule::find($id);

        // Retrieve only the selected applicants with the given IDs and 'Interview' status
        $applicantIds = $request->input('applicant_ids', []);
        $applications = Application::whereIn('id', $applicantIds)
                                ->where('status', 'Interview')
                                ->where('is_interview', false)
                                ->where('job_vacancy_id', $schedule->job_vacancy_id)
                                ->get();

        foreach ($applications as $application) {
            ScheduleLine::create([
                'schedule_id' => $id,
                'application_id' => $application->id,
            ]);
            $application->is_interview = true;
            $application->save();
        }

        return response()->json(['success' => 'Applicants generated successfully.']);
    }

}
