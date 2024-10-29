<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ChoiceStoreRequest;
use App\Http\Requests\ChoiceUpdateRequest;
use App\Http\Requests\QuestionStoreRequest;

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
        // Validasi untuk memastikan hanya satu field yang diisi (answerText atau answerImage)
        if (empty($request->answerText) && empty($request->answerImage)) {
            return redirect()->back()->withErrors('You must select at least one field: either text or image answer');
        } elseif (!empty($request->answerText) && !empty($request->answerImage)) {
            return redirect()->back()->withErrors('Please select only one field: either text or image answer');
        }

        // Ambil data validasi
        $data = $request->validated();

        // Konversi nilai checkbox is_correct menjadi boolean
        $data['is_correct'] = $request->has('is_correct'); // True jika dicentang, false jika tidak

        // Jika ada file image yang di-upload
        if ($request->hasFile('answerImage')) {
            $imagePath = $request->file('answerImage')->store('choices', 'public');
            $data['answerImage'] = $imagePath;
        }

        // Set question_id ke data yang akan disimpan
        $data['question_id'] = $question->id;

        // Simpan data choice
        $choice = Choice::create($data);

        // Redirect ke halaman pertanyaan dengan pesan sukses
        return redirect()->route('question.show', $question)->with('success', 'Choice has been created');
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
        return view('backend.choice.edit',[
            'choice' => $choice
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChoiceUpdateRequest $request, Choice $choice)
    {
        $data = $request->validated();
        $data['is_correct'] = $request->has('is_correct'); // True jika dicentang, false jika tidak
        if (empty($choice->answerImage)) {
            if (empty($request->answerText) && empty($request->answerImage)) {
                return redirect()->back()->withErrors('You must select at least one field: either text or image answer');
            } elseif (!empty($request->answerText) && !empty($request->answerImage)) {
                return redirect()->back()->withErrors('Please select only one field: either text or image answer');
            }
        }
        if ($request->answerText) {
            if ($choice->answerImage) {
                Storage::disk('public')->delete($choice->answerImage);
                $choice->answerImage = null;
            }
        }
        //check if there any file attached on field answer
        if ($request->hasFile('answerImage')) {
            //Check on column answer image, if there is a file, delete it 
            if ($choice->answerImage) {
                Storage::disk('public')->delete($choice->answerImage);
            }
            // Store the new file
            $imagePath = $request->file('answerImage')->store('choices','public');
            $data['answerImage'] = $imagePath;
            $choice->answerImage = $data['answerImage'];
        }

        $choice->label = $data['label'];
        $choice->answerText = $data['answerText'];
        $choice->is_correct = $data['is_correct'];

        $choice->save();

        return redirect()->route('question.show',$choice->question)->with('success','Choice has been updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Choice $choice)
    {
        if ($choice->answerImage) {
            Storage::disk('public')->delete($choice->answerImage);
            $choice->answerImage = null;
        }
        $choice->delete();
        return redirect()->route('question.show',$choice->question)->with('success','Choice has been deleted');
    }
}
