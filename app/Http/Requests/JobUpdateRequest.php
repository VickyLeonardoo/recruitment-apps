<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobUpdateRequest extends FormRequest
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
        return [
            'code' => 'required',
            'title' => 'required',
            'description' => 'required',
            'position_id' => 'required',
            'requirements' => 'required',
            'responsibilities' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'min_salary' => 'required','numeric',
            'max_salary' => 'required','numeric',
            'max_pax' => 'required','numeric'
        ];
    }
}
