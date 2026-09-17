<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $employee = $this->route('employee');

        return [
            'department_id' => [
                'required',
                'integer',
                'exists:departments,id',
            ],

            'employee_id' => [
                'required',
                'string',
                'max:50',
                Rule::unique('employees', 'employee_id')
                    ->ignore($employee),
            ],

            'first_name' => [
                'required',
                'string',
                'max:100',
            ],

            'last_name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('employees', 'email')
                    ->ignore($employee),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'date_of_birth' => [
                'nullable',
                'date',
            ],

            'gender' => [
                'nullable',
                'string',
                'max:20',
            ],

            'designation' => [
                'required',
                'string',
                'max:100',
            ],

            'salary' => [
                'required',
                'numeric',
                'min:0',
            ],

            'hire_date' => [
                'required',
                'date',
            ],

            'status' => [
                'required',
                'in:Active,Inactive,On Leave',
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ];
    }
}