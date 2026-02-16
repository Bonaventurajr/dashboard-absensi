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
    Route::get('/', [ReportController::class, 'index'])->name('index');
    Route::get('/export-pdf', [ReportController::class, 'exportPdf'])->name('export-pdf');
    Route::get('/export-excel', [ReportController::class, 'exportExcel'])->name('export-excel');
    Route::get('/employee/{employeeId?}', [ReportController::class, 'employeeReport'])->name('employee');
    Route::get('/daily', [ReportController::class, 'dailyReport'])->name('daily');
    Route::get('/monthly', [ReportController::class, 'monthlySummary'])->name('monthly');
});

// Help routes
Route::prefix('help')->name('help.')->group(function () {
    Route::get('/', [HelpController::class, 'index'])->name('index');
    Route::get('/getting-started', [HelpController::class, 'gettingStarted'])->name('getting-started');
    Route::get('/employee-guide', [HelpController::class, 'employeeGuide'])->name('employee-guide');
    Route::get('/attendance-guide', [HelpController::class, 'attendanceGuide'])->name('attendance-guide');
    Route::get('/reports-guide', [HelpController::class, 'reportsGuide'])->name('reports-guide');
    Route::get('/faq', [HelpController::class, 'faq'])->name('faq');
    Route::get('/contact', [HelpController::class, 'contact'])->name('contact');
    Route::post('/submit-ticket', [HelpController::class, 'submitTicket'])->name('submit-ticket');
    Route::get('/system-info', [HelpController::class, 'systemInfo'])->name('system-info');
});