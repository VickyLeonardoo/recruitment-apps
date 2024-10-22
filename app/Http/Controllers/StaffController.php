<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Staff;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\StaffStoreRequest;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\StaffUpdateRequest;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $staffs = Staff::query(); // Inisialisasi query

        if ($request->has('search')) {
            $query = $request->search;
            // Tambahkan pencarian pada kolom 'name' dan 'email'
            $staffs->where(function ($q) use ($query) {
                $q->whereHas('user', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%");
                });
            });
        }

        // Pagination 10 item per halaman
        $staffs = $staffs->with(['user', 'department'])->paginate(10);

        return view('backend.staff.index', [
            'staffs' => $staffs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('backend.staff.create',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StaffStoreRequest $request)
    {
        // Generate random password jika perlu
        $password = rand(10000000, 99999999); // Bisa digunakan jika ingin menyimpan password sementara

        // Validasi input
        $data = $request->validated();
        $date = Carbon::now()->format('Y-m-d H:i:s');
        // Buat user baru
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'email_verified_at' => $date,
            // Jika ingin menggunakan password sementara bisa tambahkan ini
            'password' => bcrypt($password), // bcrypt untuk hashing password
        ]);

        // Buat data staff baru
        $staff = Staff::create([
            'department_id' => $data['department_id'],
            'user_id' => $user->id,
        ]);

        $user->assignRole($data['role']);

        // Kirimkan link reset password ke email user
        Password::sendResetLink(['email' => $data['email']]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('staff.index')->with('success', 'Staff Created Successfully, Password reset link sent to the email.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        return view('backend.staff.edit',[
            'staff' => $staff->load('user'),
            'departments' => Department::all(),
            'role' => $staff->user->getRoleNames()->implode(', ')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StaffUpdateRequest $request, Staff $staff)
    {
        // Validasi data
        $data = $request->validated();

        // Ambil role saat ini dari user terkait
        $currentRole = $staff->user->getRoleNames()->first(); // Asumsi hanya satu role

        // Update nama user
        $staff->user->name = $data['name'];

        // Jika email berubah, set email baru dan hapus verifikasi email
        if ($staff->user->email !== $data['email']) {
            $staff->user->email = $data['email'];
            $staff->user->email_verified_at = null; // Email verifikasi direset
        }

        // Jika role berubah, update role user
        if ($currentRole !== $data['role']) {
            // Hapus role lama
            $staff->user->removeRole($currentRole);

            // Assign role baru
            $staff->user->assignRole($data['role']);
        }

        // Update department
        $staff->department_id = $data['department_id'];

        // Simpan perubahan di model User
        $staff->user->save();

        // Simpan perubahan di model Staff
        $staff->save();

        return redirect()->route('staff.index')->with('success', 'Staff updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
