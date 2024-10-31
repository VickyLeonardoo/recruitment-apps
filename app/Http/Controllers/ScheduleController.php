<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleStoreRequest;
use App\Models\JobVacancy;
use App\Models\Schedule;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
