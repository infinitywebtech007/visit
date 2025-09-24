<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('employees', EmployeeController::class);
    Route::resource('visits', VisitController::class);
    Route::resource('users', UserController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('visitors', VisitorController::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/secure-photo/{visitor}', [VisitorController::class, 'securePhoto'])->name('photo.secure');
    Route::get('/secure-id-photo/{visitor}', [VisitorController::class, 'secureID'])->name('id_photo.secure');
    Route::get('/report-by-date', [ReportController::class, 'report_by_date'])->name('report.by.date');
    Route::get('/report-by-employee', [ReportController::class, 'report_by_employee'])->name('report.by.employee');
    Route::get('/report-by-visitor', [ReportController::class, 'report_by_visitor'])->name('report.by.visitor');
});

