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
    public function index(Request $request): View
{
    $query = Employee::with('department');

    // Search by employee ID, name, email, phone, or designation
    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where('employee_id', 'like', "%{$search}%")
                ->orWhere('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('designation', 'like', "%{$search}%");

        });
    }

    // Filter by department
    if ($request->filled('department_id')) {

        $query->where(
            'department_id',
            $request->department_id
        );
    }

    // Filter by employee status
    if ($request->filled('status')) {

        $query->where(
            'status',
            $request->status
        );
    }

    // Latest employees first
    $employees = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    // Departments for filter dropdown
    $departments = Department::orderBy('name')->get();

    return view(
        'employees.index',
        compact(
            'employees',
            'departments'
        )
    );
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