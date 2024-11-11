<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobVacancy;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /** 
     * Display a listing of the resource.
     */

     public function index(Request $request)
    {
        $jobs = JobVacancy::where('status', 'active')
                    ->where('end_date', '>', Carbon::now()); // Filter active status and end date

        if ($request->has('search')) {
            $query = $request->search;

            // Add search on 'code', 'start_date', 'end_date', 'status', and 'position' relationship
            $jobs = $jobs->where(function ($q) use ($query) {
                $q->where('code', 'like', "%{$query}%")
                ->orWhere('start_date', 'like', "%{$query}%")
                ->orWhere('end_date', 'like', "%{$query}%")
                ->orWhereHas('position', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%");
                });
            });
        }

        // Order by created_at or another date column, descending to get the latest first
        $jobs = $jobs->orderBy('id', 'desc')->paginate(9);

        return view('front.job.index', [
            'jobs' => $jobs,
        ]);
    }


    // public function index()
    // {
    //     return view('frontend.job.index', [
    //         'jobs' => JobVacancy::where('status', 'active')
    //                 ->where('end_date', '>', Carbon::now())
    //                 ->get(),
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

     public function show(JobVacancy $job)
    {
        $application = false;
        $check = Application::where('user_id',auth()->user()->id)->where('job_vacancy_id',$job->id)->first();
        if($check){
            $application = $check;
        }

        return view('front.job.show',compact('job','application'));
    }

    // public function show(JobVacancy $job)
    // {
    //     $application = false;
    //     $check = Application::where('user_id',auth()->user()->id)->where('job_vacancy_id',$job->id)->first();
    //     if($check){
    //         $application = $check;
    //     }

    //     return view('frontend.job.detail',compact('job','application'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
