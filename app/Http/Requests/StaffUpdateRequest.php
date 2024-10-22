<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaffUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['superadmin','admin']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $departmentId = $this->route('users'); // Pastikan nama parameter route sesuai

        return [
            'name' => 'required',
            'department_id' => 'required',
            'role' => 'required',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($departmentId),
            ],
        ];
    }
}
