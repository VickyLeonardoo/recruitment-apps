<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobVacancy;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($job = null)
    {
        if ($job) {
            $job = JobVacancy::find($job);
            $applications = $job ? $job->application()->paginate(10) : collect();
        } else {
            $applications = Application::paginate(10);
        }

        return view('backend.application.index', [
            'applications' => $applications,
        ]);
    }

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
    public function show(Application $application)
    {
        $answer = $application->test->test_result;
        $correctAnswer = 0;

        if ($answer && $answer->count() > 0) {
            foreach ($answer as $ans) {
                if ($ans->is_correct) {
                    $correctAnswer++;
                }
            }
            $finalGrade = ($correctAnswer / $answer->count()) * 100;
        } else {
            $finalGrade = 0;
        }

        // Calculate question difficulty counts
        $question = $application->test->test_result->where('is_correct', 1);
        $question_count_easy = $question->pluck('question')->where('difficult', 'Easy')->count();
        $question_count_medium = $question->pluck('question')->where('difficult', 'Medium')->count();
        $question_count_hard = $question->pluck('question')->where('difficult', 'Hard')->count();
        $application->load('user.experience_details', 'user.education_details', 'user.skill_details','user.language_details.language');
        // Pass difficulty counts to the view
        return view('backend.application.show', [
            'application' => $application,
            'finalGrade' => $finalGrade,
            'question_count_easy' => $question_count_easy,
            'question_count_medium' => $question_count_medium,
            'question_count_hard' => $question_count_hard,
        ]);
        // return view('backend.application.show', compact(
        //     'application',
        //     'finalGrade',
        //     'question_count_easy',
        //     'question_count_medium',
        //     'question_count_hard'
        // ));


    }

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

    public function set_recommendation(Application $application){
        $text = '';
        if ($application->is_recomended == true) {
            $application->is_recomended = false;
            $text = 'Recomencation cancelled successfully';
        }else{
            $application->is_recomended = true;
            $text = 'Recommendation sent successfully';

        }
        $application->save();

        return redirect()->back()->with('success',$text);
    }

    public function set_mark($ids) {
        $applicationIds = explode(',', $ids); // Get array of IDs
        Application::whereIn('id', $applicationIds)->update(['is_mark' => true]);
    
        return redirect()->back()->with('success', 'Applications marked successfully');
    }

    public function set_unmark($ids) {
        $applicationIds = explode(',', $ids); // Get array of IDs
        Application::whereIn('id', $applicationIds)->update(['is_mark' => false]);
    
        return redirect()->back()->with('success', 'Applications unmarked successfully');
    }

    public function set_interview($ids){
        $applicationIds = explode(',', $ids); // Get array of IDs
        Application::whereIn('id', $applicationIds)->update(['status' => 'Interview']);

        return redirect()->back()->with('success', 'Applications status changed successfully');
    }

    

}
