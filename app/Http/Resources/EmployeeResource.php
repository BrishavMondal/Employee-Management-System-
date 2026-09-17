<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employee_id,

            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => trim(
                $this->first_name . ' ' . $this->last_name
            ),

            'email' => $this->email,
            'phone' => $this->phone,
            'date_of_birth' => $this->date_of_birth?->format('Y-m-d'),
            'gender' => $this->gender,
            'designation' => $this->designation,
            'salary' => $this->salary,
            'hire_date' => $this->hire_date?->format('Y-m-d'),
            'status' => $this->status,
            'address' => $this->address,

            'department' => $this->whenLoaded(
                'department',
                fn () => [
                    'id' => $this->department->id,
                    'name' => $this->department->name,
                ]
            ),

            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}