<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => [
                'required',
                'integer',
                'exists:employees,id',
            ],

            'position' => [
                'required',
                'string',
                'max:150',
            ],

            'application_date' => [
                'required',
                'date',
            ],

            'status' => [
                'required',
                'in:Applied,Shortlisted,Interview,Selected,Rejected',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.required' => 'Please select an applicant.',
            'employee_id.exists' => 'The selected applicant does not exist.',
            'position.required' => 'Position is required.',
            'position.max' => 'Position cannot exceed 150 characters.',
            'application_date.required' => 'Application date is required.',
            'application_date.date' => 'Please provide a valid application date.',
            'status.required' => 'Application status is required.',
            'status.in' => 'Invalid application status.',
            'notes.max' => 'Notes cannot exceed 2000 characters.',
        ];
    }
}