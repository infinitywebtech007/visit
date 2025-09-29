<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SecurityGuardController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false, // Disable registration route
    'reset' => false,    // Disable password reset route
    'verify' => false,   // Disable email verification route
]);

Route::middleware(['auth'])->group(function () {
    Route::resource('employees', EmployeeController::class);
    Route::resource('security-guards', SecurityGuardController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('visits', VisitController::class);
    Route::post('/visits/close/{visit}', [VisitController::class, 'close'])->name('visits.close');
    Route::get('/visit-print/{visit}', [VisitController::class, 'print'])->name('visits.print');
    Route::resource('users', UserController::class);
    Route::resource('reports', ReportController::class);
    Route::get('/change-password', [UserController::class, 'changePasswordForm'])->name('change.password.form');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('change.password');
    
    Route::resource('visitors', VisitorController::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/secure-photo/{visitor}', [VisitorController::class, 'securePhoto'])->name('photo.secure');
    Route::get('/secure-id-photo/{visitor}', [VisitorController::class, 'secureID'])->name('id_photo.secure');
    Route::get('/report-by-date', [ReportController::class, 'report_by_date'])->name('report.by.date');
    Route::get('/report-by-employee', [ReportController::class, 'report_by_employee'])->name('report.by.employee');
    Route::get('/report-by-visitor', [ReportController::class, 'report_by_visitor'])->name('report.by.visitor');
    Route::get('/roles-and-permissions', [UserController::class, 'rolesAndPermissions'])->name('roles.and.permissions');
    Route::post('/assign-role', [UserController::class, 'assignRole'])->name('assign.role');
    Route::post('/remove-role', [UserController::class, 'removeRole'])->name('remove.role');
    Route::post('/give-permission', [UserController::class, 'givePermission'])->name('give.permission');
    Route::post('/remove-permission', [UserController::class, 'removePermission'])->name('remove.permission');
    Route::post('/create-role', [UserController::class, 'createRole'])->name('create.role');
    Route::post('/delete-role', [UserController::class, 'deleteRole'])->name('delete.role');
    Route::post('/add-permission-to-role', [UserController::class, 'addPermissionToRole'])->name('add.permission.to.role');
    Route::post('/remove-permission-from-role', [UserController::class, 'removePermissionFromRole'])->name('remove.permission.from.role');
    Route::post('/create-permission', [UserController::class, 'createPermission'])->name('create.permission');
    Route::post('/delete-permission', [UserController::class, 'deletePermission'])->name('delete.permission');

    Route::post('users/deactivate/{user}', [UserController::class, 'userDeactivate'])->name('users.deactivate');
    Route::post('users/activate/{user}', [UserController::class, 'userActivate'])->name('users.activate');
});

