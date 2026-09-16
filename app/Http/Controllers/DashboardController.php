<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Employee statistics
        $totalEmployees = Employee::count();

        $activeEmployees = Employee::where(
            'status',
            'Active'
        )->count();

        $inactiveEmployees = Employee::where(
            'status',
            'Inactive'
        )->count();

        $onLeaveEmployees = Employee::where(
            'status',
            'On Leave'
        )->count();

        // Department statistics
        $totalDepartments = Department::count();

        // Recent employees
        $recentEmployees = Employee::with('department')
            ->latest()
            ->take(5)
            ->get();

        // Employees grouped by department
        $departmentStats = Department::withCount('employees')
            ->orderByDesc('employees_count')
            ->get();

        return view('dashboard', compact(
            'totalEmployees',
            'activeEmployees',
            'inactiveEmployees',
            'onLeaveEmployees',
            'totalDepartments',
            'recentEmployees',
            'departmentStats'
        ));
    }
}