<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    /**
     * Display all employees.
     */
    public function index(): View
    {
        $employees = Employee::with('department')
            ->latest()
            ->paginate(10);

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the create employee form.
     */
    public function create(): View
    {
        $departments = Department::orderBy('name')->get();

        return view('employees.create', compact('departments'));
    }

    /**
     * Store a new employee.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'department_id' => [
                'required',
                'integer',
                'exists:departments,id',
            ],

            'employee_id' => [
                'required',
                'string',
                'max:20',
                'unique:employees,employee_id',
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
                'unique:employees,email',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'date_of_birth' => [
                'nullable',
                'date',
                'before:today',
            ],

            'gender' => [
                'nullable',
                'in:Male,Female,Other',
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
                'max:9999999999.99',
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
                'max:2000',
            ],
        ]);

        Employee::create($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display a specific employee.
     */
    public function show(Employee $employee): View
    {
        $employee->load('department');

        return view('employees.show', compact('employee'));
    }

    /**
     * Show the edit employee form.
     */
    public function edit(Employee $employee): View
    {
        $departments = Department::orderBy('name')->get();

        return view('employees.edit', compact(
            'employee',
            'departments'
        ));
    }

    /**
     * Update an existing employee.
     */
    public function update(
        Request $request,
        Employee $employee
    ): RedirectResponse {
        $validated = $request->validate([
            'department_id' => [
                'required',
                'integer',
                'exists:departments,id',
            ],

            'employee_id' => [
                'required',
                'string',
                'max:20',
                'unique:employees,employee_id,' . $employee->id,
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
                'unique:employees,email,' . $employee->id,
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'date_of_birth' => [
                'nullable',
                'date',
                'before:today',
            ],

            'gender' => [
                'nullable',
                'in:Male,Female,Other',
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
                'max:9999999999.99',
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
                'max:2000',
            ],
        ]);

        $employee->update($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Delete an employee.
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}