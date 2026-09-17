<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreDepartmentRequest;
use App\Http\Requests\Api\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DepartmentController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Department::query();

        if ($request->filled('search')) {
            $search = $request->string('search');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere(
                        'description',
                        'like',
                        "%{$search}%"
                    );
            });
        }

        $departments = $query
            ->withCount('employees')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return DepartmentResource::collection($departments);
    }

    public function store(
        StoreDepartmentRequest $request
    ): DepartmentResource {
        $department = Department::create(
            $request->validated()
        );

        return new DepartmentResource($department);
    }

    public function show(
        Department $department
    ): DepartmentResource {
        $department->loadCount('employees');

        return new DepartmentResource($department);
    }

    public function update(
        UpdateDepartmentRequest $request,
        Department $department
    ): DepartmentResource {
        $department->update(
            $request->validated()
        );

        $department->loadCount('employees');

        return new DepartmentResource($department);
    }

    public function destroy(
        Department $department
    ): JsonResponse {
        if ($department->employees()->exists()) {
            return response()->json([
                'message' => 'This department cannot be deleted because it has employees assigned to it.',
            ], 409);
        }

        $department->delete();

        return response()->json([
            'message' => 'Department deleted successfully.',
        ], 200);
    }
}