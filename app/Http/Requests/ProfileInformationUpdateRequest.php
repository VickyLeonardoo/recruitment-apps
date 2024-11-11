<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileInformationUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['applicant']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->user();

        return [
            'name' => ['required', 'string'],
            'identity_no' => [
                'required',
                'string',
                'digits:16',
                Rule::unique(User::class)->ignore($user->id)
            ],
            'dob' => ['required', 'date'],
            'gender' => ['required', 'string', 'in:male,female'],
            'city' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => [
                'required',
                'string',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:10',
                'max:15',
                Rule::unique('users', 'phone')->ignore($user->id)
            ],
            'religion' => [
                'required', 
                'string',
                'in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu'
            ],
            'status' => [
                'required',
                'string',
                'in:Single,Married,Divorced'
            ],
            'nationality' => ['required', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi',
            'name.string' => 'Nama harus berupa teks',

            'identity_no.required' => 'Nomor KTP wajib diisi',
            'identity_no.digits' => 'Nomor KTP harus 16 digit',
            'identity_no.unique' => 'Nomor KTP sudah terdaftar',

            'dob.required' => 'Tanggal lahir wajib diisi',
            'dob.date' => 'Format tanggal lahir tidak valid',

            'gender.required' => 'Jenis kelamin wajib diisi',
            'gender.in' => 'Jenis kelamin harus dipilih antara laki-laki atau perempuan',

            'city.required' => 'Kota wajib diisi',
            'city.max' => 'Nama kota tidak boleh lebih dari :max karakter',

            'address.required' => 'Alamat wajib diisi',
            'address.max' => 'Alamat tidak boleh lebih dari :max karakter',

            'phone.required' => 'Nomor telepon wajib diisi',
            'phone.regex' => 'Format nomor telepon tidak valid',
            'phone.min' => 'Nomor telepon minimal :min digit',
            'phone.max' => 'Nomor telepon maksimal :max digit',
            'phone.unique' => 'Nomor telepon sudah terdaftar',

            'religion.required' => 'Agama wajib diisi',
            'religion.in' => 'Pilihan agama tidak valid',

            'status.required' => 'Status pernikahan wajib diisi',
            'status.in' => 'Pilihan status pernikahan tidak valid',

            'nationality.required' => 'Kewarganegaraan wajib diisi',
            'nationality.max' => 'Kewarganegaraan tidak boleh lebih dari :max karakter',
        ];
    }
}
