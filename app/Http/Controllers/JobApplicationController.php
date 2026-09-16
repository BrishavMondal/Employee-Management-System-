<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\JobApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobApplicationController extends Controller
{
    /**
     * Display job applications.
     */
    public function index(Request $request): View
    {
        $query = JobApplication::with('employee');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('position', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhereHas('employee', function ($employeeQuery) use ($search) {
                        $employeeQuery
                            ->where('employee_id', 'like', "%{$search}%")
                            ->orWhere('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query
            ->latest('application_date')
            ->paginate(10)
            ->withQueryString();

        return view(
            'job-applications.index',
            compact('applications')
        );
    }

    /**
     * Show create form.
     */
    public function create(): View
    {
        $employees = Employee::orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        return view(
            'job-applications.create',
            compact('employees')
        );
    }

    /**
     * Store application.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'employee_id' => [
                'required',
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
        ]);

        JobApplication::create($validated);

        return redirect()
            ->route('job-applications.index')
            ->with('success', 'Job application created successfully.');
    }

    /**
     * Display application.
     */
    public function show(JobApplication $jobApplication): View
    {
        $jobApplication->load('employee.department');

        return view(
            'job-applications.show',
            compact('jobApplication')
        );
    }

    /**
     * Show edit form.
     */
    public function edit(JobApplication $jobApplication): View
    {
        $employees = Employee::orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        return view(
            'job-applications.edit',
            compact('jobApplication', 'employees')
        );
    }

    /**
     * Update application.
     */
    public function update(
        Request $request,
        JobApplication $jobApplication
    ): RedirectResponse {
        $validated = $request->validate([
            'employee_id' => [
                'required',
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
        ]);

        $jobApplication->update($validated);

        return redirect()
            ->route('job-applications.index')
            ->with('success', 'Job application updated successfully.');
    }

    /**
     * Delete application.
     */
    public function destroy(
        JobApplication $jobApplication
    ): RedirectResponse {
        $jobApplication->delete();

        return redirect()
            ->route('job-applications.index')
            ->with('success', 'Job application deleted successfully.');
    }
}