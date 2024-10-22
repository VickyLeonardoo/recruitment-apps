<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChoiceStoreRequest;
use App\Http\Requests\QuestionStoreRequest;
use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;

class ChoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Question $question)
    {
        
        return view('backend.choice.create',compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChoiceStoreRequest $request, Question $question)
    {
        if (empty($request->answerText) && empty($request->answerImage)) {
            return redirect()->back()->withErrors('You must select at least one field: either text or image answer');
        } elseif (!empty($request->answerText) && !empty($request->answerImage)) {
            return redirect()->back()->withErrors('Please select only one field: either text or image answer');
        }
        return 'test';
        $data = $request->validated();
        $data['question_id'] = $question->id;

        $choice = Choice::create($data);
        return redirect()->route('question.show',$question)->with('success','Choice has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Choice $choice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Choice $choice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Choice $choice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Choice $choice)
    {
        //
    }
}
