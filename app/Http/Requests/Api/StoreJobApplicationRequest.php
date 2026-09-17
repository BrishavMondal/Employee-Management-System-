<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobApplicationRequest extends FormRequest
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
}