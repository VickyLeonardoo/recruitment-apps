<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobStoreRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Models\Position;
use App\Models\JobVacancy;
use Illuminate\Http\Request;

class JobVacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jobs = JobVacancy::with('position', 'application'); // Eager load relationships
 
        if ($request->has('search')) {
            $query = $request->search;

            // Add search on 'code', 'start_date', 'end_date', 'status', and 'position' relationship
            $jobs = $jobs->where(function ($q) use ($query) {
                $q->where('code', 'like', "%{$query}%")
                ->orWhere('start_date', 'like', "%{$query}%")
                ->orWhere('end_date', 'like', "%{$query}%")
                ->orWhere('status', 'like', "%{$query}%")
                ->orWhereHas('position', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%");
                });
            });
        }

        // Order by created_at or another date column, descending to get the latest first
        $jobs = $jobs->orderBy('id', 'desc')->paginate(10);

        return view('backend.job.index', [
            'jobs' => $jobs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::all();
        return view('backend.job.create',[
            'positions' => $positions->load('department'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobStoreRequest $request)
    {
        $data = $request->validated();
        if ($request->start_date > $request->end_date) {
            return redirect()->back()
                ->withErrors('End Date must be greater than Start Date')
                ->withInput(); // Menambahkan withInput
        }
    
        if ($request->max_salary < $request->min_salary) {
            return redirect()->back()
                ->withErrors('Max Salary must be greater than Min Salary')
                ->withInput(); // Menambahkan withInput
        }
        
        $job = JobVacancy::create($data);

        return redirect()->route('job.index')->with('success','Job Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobVacancy $job)
    {
        return view('backend.job.show',[
            'job' => $job,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobVacancy $job)
    {

        $positions = Position::all();
        return view('backend.job.edit',compact('job','positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobUpdateRequest $request, JobVacancy $job)
    {
        $data = $request->validated();
        if ($request->start_date > $request->end_date) {
            return redirect()->back()
                ->withErrors('End Date must be greater than Start Date')
                ->withInput(); // Menambahkan withInput
        }
    
        if ($request->max_salary < $request->min_salary) {
            return redirect()->back()
                ->withErrors('Max Salary must be greater than Min Salary')
                ->withInput(); // Menambahkan withInput
        }

        $job->update($data);

        return redirect()->route('job.index')->with('success','Job Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobVacancy $job)
    {
        $job->delete();
        return redirect()->route('job.index')->with('success','Job Deleted Successfully');
    }

    public function set_to_draft(JobVacancy $job){
        $job->status = 'Draft';
        $job->save();
        return redirect()->route('job.show',$job)->with('success','Job Updated Successfully');
    }

    public function set_to_cancel(JobVacancy $job){
        $job->status = 'Cancelled';
        $job->save();
        return redirect()->route('job.show',$job)->with('success','Job Updated Successfully');
    }

    public function set_to_active(JobVacancy $job){
        $job->status = 'Active';
        $job->save();
        return redirect()->route('job.show',$job)->with('success','Job Updated Successfully');
    }

    public function set_to_done(JobVacancy $job){
        $job->status = 'Done';
        $job->save();
        return redirect()->route('job.show',$job)->with('success','Job Updated Successfully');
    }

    public function view_applicant(JobVacancy $job){
     
    }

}
