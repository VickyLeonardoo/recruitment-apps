<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\QuestionStoreRequest;
use App\Http\Requests\QuestionUpdateRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $questions = Question::query(); // Inisialisasi query

        if ($request->has('search')) {
            $query = $request->search;
            // Tambahkan pencarian pada kolom 'code' dan 'name'
            $questions = $questions->where(function ($q) use ($query) {
                $q->where('description', 'like', "%{$query}%")
                ->orWhere('difficult', 'like', "%{$query}%");

            });
        }

        // Pagination 10 item per halaman
        $questions = $questions->paginate(10);

        return view('backend.question.index',[
            'questions' => $questions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.question.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionStoreRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('questions','public');
            $data['image'] = $imagePath;
        }
        $question = Question::create($data);

        return redirect()->route('question.show',$question)->with('success','Question Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return view('backend.question.show',[
            'question' => $question->load('choice'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        return view('backend.question.edit',[
            'question' => $question,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionUpdateRequest $request, Question $question)
    {
        $data = $request->validated();

        // Periksa jika ada file gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($question->image) {
                Storage::disk('public')->delete($question->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('questions', 'public');
            $question['image'] = $imagePath;
        }

        // Update informasi pertanyaan
        $question->description = $data['description'];
        $question->difficult = $data['difficult'];

        $question->save();

        return redirect()->route('question.show', $question)->with('success', 'Question Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('question.index')->with('success','Question Deleted Successfully');
    }
}
