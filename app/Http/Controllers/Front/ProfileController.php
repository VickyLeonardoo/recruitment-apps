<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EducationStoreRequest;
use App\Http\Requests\EducationUpdateRequest;
use App\Http\Requests\ExperienceStoreRequest;
use App\Http\Requests\ExperienceUpdateRequest;
use App\Http\Requests\SkillStoreRequest;
use App\Http\Requests\SkillUpdateRequest;
use App\Models\EducationDetail;
use App\Models\ExperienceDetail;
use App\Models\Language;
use App\Models\LanguageDetails;
use App\Models\Skill;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.profile.index');
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

    public function store_my_education(EducationStoreRequest $request){
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $education = EducationDetail::create($data);
        return redirect()->back()->with('success','Education has been added');
    }

    public function store_my_experience(ExperienceStoreRequest $request)
    {
        $data = $request->validated();

        // Mengonversi format tanggal dari m/d/Y ke Y-m-d
        $data['start_date'] = Carbon::createFromFormat('m/d/Y', $data['start_date'])->format('Y-m-d');
        $data['end_date'] = Carbon::createFromFormat('m/d/Y', $data['end_date'])->format('Y-m-d');

        // Menambahkan user_id dari user yang sedang login
        $data['user_id'] = auth()->user()->id;

        // Menyimpan data ke dalam tabel experience_details
        $experience = ExperienceDetail::create($data);

        return redirect()->back()->with('success', 'Experience has been added');
    }

    public function store_my_skill(SkillStoreRequest $request)
    {
        $data = $request->validated();
        // Menambahkan user_id dari user yang sedang login
        $data['user_id'] = auth()->user()->id;

        // Menyimpan data ke dalam tabel experience_details
        $experience = Skill::create($data);

        return redirect()->back()->with('success', 'Experience has been added');
    }

    public function store_my_language(Request $request)
    {
        $data = $request->validate([
            'language_id' => 'required',
            'level' => 'required'
        ],[
            'language_id.required' => 'Nama bahasa harus diisi',
            'level.required' => 'Level keahlian harus diisi',
        ]);

        $data['user_id'] =  auth()->user()->id;

        // Menyimpan data ke dalam tabel experience_details
        $language = LanguageDetails::create($data);

        return redirect()->back()->with('success', 'Experience has been added');
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

    public function show_my_info(){
        return view('frontend.profile.show');
    }

    public function show_my_education(){
        return view('frontend.profile.education');
    }

    public function show_my_experience(){
        return view('frontend.profile.experience');
    }

    public function show_my_skill(){
        return view('frontend.profile.skills');
    }

    public function show_my_language(){
        $langs = Language::all();
        return view('frontend.profile.language',[
            'langs' => $langs
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
    public function update(Request $request, User $user)
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'identity_no' => 'required|string|digits:16|unique:users,identity_no,' . ($user->id ?? 'NULL'),
            'dob' => 'required|date',
            'gender' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string|unique:users,phone,' . ($user->id ?? 'NULL'),
            'religion' => 'required|string',
            'status' => 'required|string',
            'nationality' => 'required|string',
        ]);
    
        // Hitung usia berdasarkan tanggal lahir
        $age = Carbon::parse($request->dob)->age;
        
        // Jika usia kurang dari 18 tahun, kembalikan dengan error
        if ($age < 18) {
            return redirect()->back()->withErrors(['dob' => 'Umur minimal adalah 18 tahun.'])->withInput();
        }
        
        // Cek apakah user_detail sudah ada
            // Jika user_detail ada, lakukan update
    
        $user->identity_no = $request->identity_no;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->religion = $request->religion;
        $user->status = $request->status;
        $user->nationality = $request->nationality;
        $user->save();
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function update_my_education(EducationUpdateRequest $request, EducationDetail $education){

        $data = $request->validated();

        $education->update($data);

        return redirect()->back()->with('success','Education has been updated');
    }

    public function update_my_experience(ExperienceUpdateRequest $request, ExperienceDetail $experience){

        $data = $request->validated();

        $experience->update($data);

        return redirect()->back()->with('success','Experience has been updated');
    }

    public function update_my_skill(SkillUpdateRequest $request, Skill $skill){

        $data = $request->validated();

        $skill->update($data);

        return redirect()->back()->with('success','Experience has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function destroy_my_education(EducationDetail $education){
        $education->delete();
        return redirect()->back()->with('success','Education has been deleted');
    }

    public function destroy_my_experience(ExperienceDetail $experience){
        $experience->delete();
        return redirect()->back()->with('success','Education has been deleted');
    }

    public function destroy_my_skill(Skill $skill){
        $skill->delete();
        return redirect()->back()->with('success','Education has been deleted');
    }

    public function destroy_my_language(LanguageDetails $language){
        $language->delete();
        return redirect()->back()->with('success','Education has been deleted');
    }

}
