<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationStoreRequest extends FormRequest
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
        return [
            'degree' => 'required','string',
            'major' => 'required','string',
            'institution' => 'required','string',
            'entry_year' => 'required','digits:4',
            'end_year' => 'required','digits:4',
            'grade' => 'required','numeric','regex:/^\d{1,3}(\.\d{1,2})?$/',
        ];
    }
}
