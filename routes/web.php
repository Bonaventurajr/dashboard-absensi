<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\Auth\LoginController;

// Public routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    
    // Employees
    Route::resource('employees', EmployeeController::class);
    
    // Attendance
    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::post('/attendance/checkin', [AttendanceController::class, 'checkIn'])->name('attendance.checkin');
    Route::post('/attendance/checkout', [AttendanceController::class, 'checkOut'])->name('attendance.checkout');
    
    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/export-pdf', [ReportController::class, 'exportPdf'])->name('export-pdf');
        Route::get('/export-excel', [ReportController::class, 'exportExcel'])->name('export-excel');
    });
    
    // Help
    Route::prefix('help')->name('help.')->group(function () {
        Route::get('/', [HelpController::class, 'index'])->name('index');
        Route::get('/getting-started', [HelpController::class, 'gettingStarted'])->name('getting-started');
        Route::get('/employee-guide', [HelpController::class, 'employeeGuide'])->name('employee-guide');
        Route::get('/attendance-guide', [HelpController::class, 'attendanceGuide'])->name('attendance-guide');
        Route::get('/reports-guide', [HelpController::class, 'reportsGuide'])->name('reports-guide');
        Route::get('/faq', [HelpController::class, 'faq'])->name('faq');
        Route::get('/contact', [HelpController::class, 'contact'])->name('contact');
    });
});

// Settings routes - HANYA UNTUK ADMIN
Route::middleware(['auth', 'admin'])->prefix('settings')->name('settings.')->group(function () {
    Route::get('/', [SettingsController::class, 'index'])->name('index');
    Route::post('/general', [SettingsController::class, 'updateGeneral'])->name('update.general');
    Route::post('/attendance', [SettingsController::class, 'updateAttendance'])->name('update.attendance');
    Route::post('/notifications', [SettingsController::class, 'updateNotifications'])->name('update.notifications');
    Route::get('/backup', [SettingsController::class, 'backup'])->name('backup');
    Route::post('/backup/create', [SettingsController::class, 'createBackup'])->name('backup.create');
    Route::post('/backup/restore', [SettingsController::class, 'restoreBackup'])->name('backup.restore');
    Route::get('/users', [SettingsController::class, 'users'])->name('users');
});