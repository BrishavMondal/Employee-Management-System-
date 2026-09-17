<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(): View
    {
        $departments = Department::withCount('employees')
            ->latest()
            ->paginate(10);

        return view('departments.index', compact('departments'));
    }

    public function create(): View
    {
        return view('departments.create');
    }

    public function store(
        StoreDepartmentRequest $request
    ): RedirectResponse {
        Department::create($request->validated());

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department created successfully.');
    }

    public function show(Department $department): View
    {
        $department->load([
            'employees' => function ($query) {
                $query->latest();
            },
        ]);

        return view('departments.show', compact('department'));
    }

    public function edit(Department $department): View
    {
        return view('departments.edit', compact('department'));
    }

    public function update(
        UpdateDepartmentRequest $request,
        Department $department
    ): RedirectResponse {
        $department->update($request->validated());

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department updated successfully.');
    }

    public function destroy(
        Department $department
    ): RedirectResponse {
        if ($department->employees()->exists()) {
            return redirect()
                ->route('departments.index')
                ->with(
                    'error',
                    'This department cannot be deleted because it has employees assigned to it.'
                );
        }

        $department->delete();

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}