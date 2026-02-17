<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HelpController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Employee routes
Route::resource('employees', EmployeeController::class);

// Attendance routes
Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
Route::post('/attendance/checkin', [AttendanceController::class, 'checkIn'])->name('attendance.checkin');
Route::post('/attendance/checkout', [AttendanceController::class, 'checkOut'])->name('attendance.checkout');

// Report routes
Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/', [App\Http\Controllers\ReportController::class, 'index'])->name('index');
    Route::get('/export-pdf', [App\Http\Controllers\ReportController::class, 'exportPdf'])->name('export-pdf');
    Route::get('/export-excel', [App\Http\Controllers\ReportController::class, 'exportExcel'])->name('export-excel');
    Route::get('/employee/{employeeId?}', [App\Http\Controllers\ReportController::class, 'employeeReport'])->name('employee');
    Route::get('/daily', [App\Http\Controllers\ReportController::class, 'dailyReport'])->name('daily');
    Route::get('/monthly', [App\Http\Controllers\ReportController::class, 'monthlySummary'])->name('monthly');
});

// Help routes
Route::prefix('help')->name('help.')->group(function () {
    Route::get('/', [App\Http\Controllers\HelpController::class, 'index'])->name('index');
    Route::get('/getting-started', [App\Http\Controllers\HelpController::class, 'gettingStarted'])->name('getting-started');
    Route::get('/employee-guide', [App\Http\Controllers\HelpController::class, 'employeeGuide'])->name('employee-guide');
    Route::get('/attendance-guide', [App\Http\Controllers\HelpController::class, 'attendanceGuide'])->name('attendance-guide');
    Route::get('/reports-guide', [App\Http\Controllers\HelpController::class, 'reportsGuide'])->name('reports-guide');
    Route::get('/faq', [App\Http\Controllers\HelpController::class, 'faq'])->name('faq');
    Route::get('/contact', [App\Http\Controllers\HelpController::class, 'contact'])->name('contact');
    Route::post('/submit-ticket', [App\Http\Controllers\HelpController::class, 'submitTicket'])->name('submit-ticket');
    Route::get('/system-info', [App\Http\Controllers\HelpController::class, 'systemInfo'])->name('system-info');
});

// Settings routes
Route::prefix('settings')->name('settings.')->group(function () {
    Route::get('/', [App\Http\Controllers\SettingsController::class, 'index'])->name('index');
    Route::post('/general', [App\Http\Controllers\SettingsController::class, 'updateGeneral'])->name('update.general');
    Route::post('/attendance', [App\Http\Controllers\SettingsController::class, 'updateAttendance'])->name('update.attendance');
    Route::post('/notifications', [App\Http\Controllers\SettingsController::class, 'updateNotifications'])->name('update.notifications');
    Route::get('/backup', [App\Http\Controllers\SettingsController::class, 'backup'])->name('backup');
    Route::post('/backup/create', [App\Http\Controllers\SettingsController::class, 'createBackup'])->name('backup.create');
    Route::post('/backup/restore', [App\Http\Controllers\SettingsController::class, 'restoreBackup'])->name('backup.restore');
    Route::get('/users', [App\Http\Controllers\SettingsController::class, 'users'])->name('users');
});