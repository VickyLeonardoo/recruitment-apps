<?php

namespace App\Http\Controllers\Front;

use App\Models\Test;
use App\Models\JobVacancy;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $user_id = auth()->user()->id;
    //     $apps = Application::where('user_id', $user_id)->get();
    //     return view('frontend.application.index',[
    //         'apps' => $apps
    //     ]);
    // }

    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $sort = $request->query('sort', 'newest'); // Default ke 'newest' jika tidak ada parameter
    
        $query = Application::where('user_id', $user_id);
    
        // Tentukan urutan berdasarkan pilihan
        if ($sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        }
    
        $apps = $query->paginate();
    
        return view('front.application.index', [
            'applications' => $apps,
            'selectedSort' => $sort, // Mengirim pilihan urutan ke view
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
        $userId = auth()->user()->id;
        $jobId = $request->job_id; 
        
        $checkAppliation = Application::where('user_id',$userId)->latest()->first();
        if ($checkAppliation) {
            if (in_array($checkAppliation->status, ['Pending'])) {
                return back()->with('error', 'Gagal! Anda hanya dapat melakukan pendaftaran sekali dalam satu waktu');
            } 
        }
        $alreadyApply = Application::where('job_vacancy_id', $jobId)->where('user_id' ,$userId)->first();
        if ($alreadyApply) {
            return back()->with('error', 'Gagal! Anda hanya dapat melakukan pendaftaran sekali dalam satu waktu');
        }
        if (auth()->user()->education_details->count() == 0) {
            return back()->with('error', 'Gagal! Anda harus mengisi data pendidikan terlebih dahulu');
        }


        try {
            // Start the transaction
            DB::beginTransaction();

            // Generate reg_no with format MC{year}{month}{day}{microsecond}
            $reg_no = 'MC' . now()->format('YmdHisu');

            $application = Application::create([
                'reg_no' => $reg_no,
                'user_id' => $userId,
                'job_vacancy_id' => $jobId,
                'reg_date' => now(),
                'status' => 'pending',
            ]);

            $lastTestNumber = Test::max('test_no') ?? 'PT000000';
            $newTestNumber = 'PT' . str_pad(intval(substr($lastTestNumber, 2)) + 1, 6, '0', STR_PAD_LEFT);

            Test::create([
                'test_no' => $newTestNumber,
                'user_id' => $userId,
                'status' => 'DRAFT',
                'name' => 'Basic External',
                'duration' => '40',
                'application_id' => $application->id,
            ]);

            // If we've gotten this far, it means both inserts were successful.
            // So, let's commit the transaction.
            DB::commit();
            
            return redirect()->route('applicant.application.show', $application)
                            ->with('success', 'Berhasil melakukan pendaftaran');
        } catch (\Exception $e) {
            // Something went wrong, let's rollback the transaction
            DB::rollBack();

            // Log the error
            Log::error('Error in applyJob: ' . $e->getMessage());

            return back()->with('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    
     public function show(Application $application)
    {
        if (!$application){
            return view('errors/404');
        }
        return view('front.application.show',[
            'application' => $application,
        ]);
    }

    // public function show(Application $application)
    // {
    //     if (!$application){
    //         return view('errors/404');
    //     }
    //     return view('frontend.application.detail',[
    //         'application' => $application,
    //     ]);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $apl)
    {
        
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
