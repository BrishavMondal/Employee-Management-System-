<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobApplicationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', function () {
    return view('welcome');
});


// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// Authenticated routes
Route::middleware('auth')->group(function () {

    // Departments
    Route::resource('departments', DepartmentController::class);

    // Employees
    Route::resource('employees', EmployeeController::class);

    // Job Applications
    Route::resource('job-applications', JobApplicationController::class);
});


// Authentication routes
require __DIR__ . '/auth.php';