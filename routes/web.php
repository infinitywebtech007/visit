<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
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
    Route::resource('visitors', VisitorController::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/secure-photo/{filename}', [VisitorController::class, 'securePhoto'])->name('photo.secure');

});

