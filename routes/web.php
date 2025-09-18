<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('employees', App\Http\Controllers\EmployeeController::class);
Route::resource('visits', App\Http\Controllers\VisitController::class);
Route::resource('visitors', App\Http\Controllers\VisitorController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
