<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Test;
use App\Models\Question;
use App\Models\TestResult;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function startTest(Application $application) {
        DB::beginTransaction(); // Mulai transaksi
    
        try {
            $test = $application->test;
            $id = $test->id;

            // Cek apakah tes sudah dimulai (start_time belum diset)
            if (!$test->start_time) {
                // Jika belum, set waktu mulai dan status tes
                $test->start_time = now();
                $test->is_start = true;  // Gunakan assignment '=' bukan '=='
                $test->status = 'OPEN';  // Gunakan assignment '=' bukan '=='
                $test->save();
            }
    
            // Cek apakah test_results sudah ada untuk test_id ini
            $existingResults = TestResult::where('test_id', $id)->exists();
    
            // Jika test_results belum ada, baru buat test_results
            if (!$existingResults) {
                // Ambil 20 soal acak
                $questions = Question::inRandomOrder()->take(20)->get();
    
                // Loop untuk setiap soal dan buat entry di test_results
                foreach ($questions as $index => $question) {
                    TestResult::create([
                        'test_id' => $id,               // ID tes yang diikuti, dari parameter $id
                        'question_id' => $question->id, // ID soal
                        'choice_id' => null,            // Jawaban user (belum dijawab, jadi null dulu)
                        'is_correct' => false,          // Belum dijawab, jadi anggap salah dulu
                        'no' => $index + 1              // Nomor urut soal
                    ]);
                }
            }
    
            DB::commit(); // Semua operasi berhasil, commit transaksi
            return redirect()->back()->with('success', 'Tes dimulai!');
    
        } catch (\Exception $e) {
            DB::rollBack(); // Terjadi kesalahan, rollback semua perubahan
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memulai tes: ' . $e->getMessage());
        }
    }

    public function continueTest(Application $application)
    {
        $testFind = $application->test;
        $test = TestResult::where('test_id', $testFind->id)
            ->with(['question.choice'])
            ->get();

        if ($testFind->status == 'COMPLETED') {
            return redirect()->back()->with('error', 'Test sudah selesai, kamu tidak dapat melanjutkan');
        }

        $select = $test[0];

        // Pastikan start_time menggunakan timezone UTC
        $startTime = Carbon::parse($select->test->start_time)->format('Y-m-d\TH:i:s\Z');

        return view('frontend.application.test', [
            'tests' => $test,
            'start_time' => $startTime,
        ]);
    }

    public function saveAnswer(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'choice_id' => 'required|exists:choices,id',
        ]);

        // Cari atau buat test result untuk menyimpan jawaban
        $testResult = TestResult::where('question_id', $request->question_id)
                                ->where('test_id', $request->test_id) // pastikan test_id juga cocok
                                ->firstOrFail();

        // Simpan jawaban
        $testResult->choice_id = $request->choice_id;
        $testResult->is_correct = $this->checkAnswer($request->question_id, $request->choice_id);
        $testResult->save();

        // Kembalikan response sukses
        return response()->json(['success' => true]);
    }

    private function checkAnswer($questionId, $choiceId)
    {
        // Implementasikan logika untuk memeriksa jawaban dan mengembalikan hasilnya
        $question = Question::find($questionId);
        if (!$question) {
            return false; // Jika pertanyaan tidak ditemukan, return false
        }
        $choice = $question->choice->where('id', $choiceId)->first();

        // Periksa apakah pilihan ditemukan dan is_correct adalah true
        if ($choice && $choice->is_correct) {
            return true; // Jawaban benar
        }
    
        return false; // Jawaban salah
    }

    public function submitApplication($id)
    {
        $test = Test::find($id);
        if (!$test->end_time) {
            // Jika belum, set waktu mulai dan status tes
            $test->end_time = now();
            $test->status = 'COMPLETED';  // Gunakan assignment '=' bukan '=='
            $test->save();
        }
        
        return redirect()->route('applicant.application.detail',$test->application->id)->with('success','Tes telah selesai!');
    }
}
