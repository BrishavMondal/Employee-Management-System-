<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobApplicationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'position' => $this->position,

            'application_date' => $this->application_date
                ?->format('Y-m-d'),

            'status' => $this->status,

            'notes' => $this->notes,

            'employee' => $this->whenLoaded(
                'employee',
                fn () => [
                    'id' => $this->employee->id,
                    'employee_id' => $this->employee->employee_id,
                    'name' => trim(
                        $this->employee->first_name
                        . ' '
                        . $this->employee->last_name
                    ),
                    'email' => $this->employee->email,
                ]
            ),

            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}