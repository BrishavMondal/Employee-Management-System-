<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreEmployeeRequest;
use App\Http\Requests\Api\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EmployeeController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Employee::with('department');

        if ($request->filled('search')) {
            $search = $request->string('search');

            $query->where(function ($q) use ($search) {
                $q->where(
                    'employee_id',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'first_name',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'last_name',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'email',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'phone',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'designation',
                    'like',
                    "%{$search}%"
                );
            });
        }

        if ($request->filled('department_id')) {
            $query->where(
                'department_id',
                $request->department_id
            );
        }

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        $employees = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return EmployeeResource::collection($employees);
    }

    public function store(
        StoreEmployeeRequest $request
    ): EmployeeResource {
        $employee = Employee::create(
            $request->validated()
        );

        $employee->load('department');

        return new EmployeeResource($employee);
    }

    public function show(
        Employee $employee
    ): EmployeeResource {
        $employee->load([
            'department',
            'jobApplications',
        ]);

        return new EmployeeResource($employee);
    }

    public function update(
        UpdateEmployeeRequest $request,
        Employee $employee
    ): EmployeeResource {
        $employee->update(
            $request->validated()
        );

        $employee->load('department');

        return new EmployeeResource($employee);
    }

    public function destroy(
        Employee $employee
    ): JsonResponse {
        if ($employee->jobApplications()->exists()) {
            return response()->json([
                'message' => 'This employee cannot be deleted because job applications are associated with the employee.',
            ], 409);
        }

        $employee->delete();

        return response()->json([
            'message' => 'Employee deleted successfully.',
        ], 200);
    }
}