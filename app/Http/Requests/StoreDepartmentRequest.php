<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:departments,name',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Department name is required.',
            'name.unique' => 'This department already exists.',
            'name.max' => 'Department name cannot exceed 100 characters.',
            'description.max' => 'Description cannot exceed 1000 characters.',
        ];
    }
}