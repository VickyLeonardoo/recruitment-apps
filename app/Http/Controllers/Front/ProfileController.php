<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Skill;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\EducationDetail;
use App\Models\LanguageDetails;
use App\Models\ExperienceDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SkillStoreRequest;
use App\Http\Requests\SkillUpdateRequest;
use App\Http\Requests\EducationStoreRequest;
use App\Http\Requests\EducationUpdateRequest;
use App\Http\Requests\ExperienceStoreRequest;
use App\Http\Requests\ExperienceUpdateRequest;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\ProfileInformationUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     return view('frontend.profile.index');
    // }

    public function index()
    {
        return view('front.profile.my-info');
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

    public function store_education(EducationStoreRequest $request){
        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;
        
        $education = EducationDetail::create($data);

        return redirect()->back()->with('success', 'Informasi pendidikan berhasil diperbarui')->with(['tab' => 'Pendidikan']);
    }

    public function store_skill(SkillStoreRequest $request)
    {
        $data = $request->validated();
        // Menambahkan user_id dari user yang sedang login
        $data['user_id'] = auth()->user()->id;

        // Menyimpan data ke dalam tabel experience_details
        $experience = Skill::create($data);

        return redirect()->back()->with('success', 'Informasi keahlian berhasil diperbarui')->with(['tab' => 'Skill']);

    }

    public function store_experience(ExperienceStoreRequest $request)
    {
        $data = $request->validated();

        // // Mengonversi format tanggal dari m/d/Y ke Y-m-d
        // $data['start_date'] = Carbon::createFromFormat('m/d/Y', $data['start_date'])->format('Y-m-d');
        // $data['end_date'] = Carbon::createFromFormat('m/d/Y', $data['end_date'])->format('Y-m-d');

        // Menambahkan user_id dari user yang sedang login
        $data['user_id'] = auth()->user()->id;

        // Menyimpan data ke dalam tabel experience_details
        $experience = ExperienceDetail::create($data);

        return redirect()->back()->with('success', 'Pengalaman berhasil diperbarui')->with(['tab' => 'Pengalaman']);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('frontend.profile.show');
    }

    public function show_overview(){
        $user = auth()->user()->load('education_details')->load('language_details')->load('skill_details'); 
        // return $user->load('experience_details');
        return view('frontend.profile.overview',[
            'user' => $user
        ]);
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

    public function update_personal_information(ProfileInformationUpdateRequest $request)
    {
        $data = $request->validated();
        
        try {
            // Update user information
            $user = Auth::user();
            
            $user->update([
                'name' => $data['name'],
                'identity_no' => $data['identity_no'],
                'phone' => $data['phone'],
                'dob' => $data['dob'],
                'gender' => $data['gender'],
                'status' => $data['status'],
                'religion' => $data['religion'],
                'nationality' => $data['nationality'],
                'city' => $data['city'],
                'address' => $data['address']
            ]);

            return redirect()->back()->with('success', 'Informasi pribadi berhasil diperbarui')->with(['tab' => 'InformasiPribadi']);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui informasi pribadi')->withInput()->with(['tab' => 'InformasiPribadi']);
        }
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048'
        ]);

        try {
            // Get current user
            $user = auth()->user();
            $oldPhotoPath = $user->profile_picture;
            
            // Store new photo
            $newPhotoPath = $request->file('photo')->store('profile-pictures', 'public');
            
            if (!$newPhotoPath) {
                throw new \Exception('Failed to upload new photo');
            }

            // Update user's photo in database
            $user->update([
                'profile_picture' => $newPhotoPath
            ]);

            // If update successful and old photo exists, delete it
            if ($oldPhotoPath && Storage::disk('public')->exists($oldPhotoPath)) {
                try {
                    Storage::disk('public')->delete($oldPhotoPath);
                } catch (\Exception $e) {
                    // Log the error but don't fail the whole operation
                    \Log::warning("Failed to delete old profile picture: {$oldPhotoPath}", [
                        'error' => $e->getMessage()
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Photo updated successfully');

        } catch (\Exception $e) {
            // If something went wrong and we uploaded a new photo, attempt to clean it up
            if (isset($newPhotoPath) && Storage::disk('public')->exists($newPhotoPath)) {
                Storage::disk('public')->delete($newPhotoPath);
            }

            return redirect()->back()->with('error', 'Error updating photo: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function destroy_education(EducationDetail $education){
        $education->delete();
        return redirect()->back()->with('success','Education has been deleted')->with(['tab' => 'Pendidikan']);
    }

    public function destroy_skill(Skill $skill){
        $skill->delete();
        return redirect()->back()->with('success','Keahlilan berhasil diperbarui')->with(['tab' => 'Skill']);
    }

    public function destroy_experience(ExperienceDetail $experience){
        $experience->delete();
        return redirect()->back()->with('success','Pengalaman berhasil diperbarui')->with(['tab' => 'Pengalaman']);
    }

    public function destroy_my_language(LanguageDetails $language){
        $language->delete();
        return redirect()->back()->with('success','Education has been deleted');
    }

}
