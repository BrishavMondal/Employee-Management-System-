<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Requests\UpdateJobApplicationRequest;
use App\Models\Employee;
use App\Models\JobApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobApplicationController extends Controller
{
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

    public function store(
        StoreJobApplicationRequest $request
    ): RedirectResponse {
        JobApplication::create($request->validated());

        return redirect()
            ->route('job-applications.index')
            ->with('success', 'Job application created successfully.');
    }

    public function show(JobApplication $jobApplication): View
    {
        $jobApplication->load('employee.department');

        return view(
            'job-applications.show',
            compact('jobApplication')
        );
    }

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

    public function update(
        UpdateJobApplicationRequest $request,
        JobApplication $jobApplication
    ): RedirectResponse {
        $jobApplication->update($request->validated());

        return redirect()
            ->route('job-applications.index')
            ->with('success', 'Job application updated successfully.');
    }

    public function destroy(
        JobApplication $jobApplication
    ): RedirectResponse {
        $jobApplication->delete();

        return redirect()
            ->route('job-applications.index')
            ->with('success', 'Job application deleted successfully.');
    }
}