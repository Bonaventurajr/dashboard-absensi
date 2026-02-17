@extends('layouts.app')

@section('title', 'Attendance Guide')

@section('content')
<div class="container-fluid px-0">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('help.index') }}" class="btn btn-outline-secondary me-3">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <div>
                            <h4 class="mb-2">
                                <i class="fas fa-calendar-check text-warning me-2"></i>
                                Attendance Guide
                            </h4>
                            <p class="text-muted mb-0">Learn how to record and manage attendance</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Check In Process -->
            <div class="card stat-card mb-4">
                <div class="card-body">
                    <h5 class="mb-3">
                        <span class="badge bg-success me-2">1</span>
                        How to Check In
                    </h5>
                    <div class="ms-4">
                        <p class="text-muted">To record a check-in:</p>
                        <ol class="text-muted">
                            <li>Go to the <strong>Dashboard</strong> or <strong>Attendance</strong> page</li>
                            <li>Click the <span class="badge bg-primary">Check In</span> button</li>
                            <li>Select the employee from the dropdown</li>
                            <li>Optional: Take a photo for verification</li>
                            <li>Click <span class="badge bg-primary">Check In</span> to confirm</li>
                        </ol>
                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle me-2"></i>
                            Check-in time is automatically recorded. If check-in is after 08:00, status will be "Late".
                        </div>
                    </div>
                </div>
            </div>

            <!-- Check Out Process -->
            <div class="card stat-card mb-4">
                <div class="card-body">
                    <h5 class="mb-3">
                        <span class="badge bg-warning me-2">2</span>
                        How to Check Out
                    </h5>
                    <div class="ms-4">
                        <p class="text-muted">To record a check-out:</p>
                        <ol class="text-muted">
                            <li>Go to the <strong>Dashboard</strong> or <strong>Attendance</strong> page</li>
                            <li>Click the <span class="badge bg-success">Check Out</span> button</li>
                            <li>Select the employee who is checking out</li>
                            <li>Optional: Take a photo for verification</li>
                            <li>Click <span class="badge bg-success">Check Out</span> to confirm</li>
                        </ol>
                        <div class="alert alert-warning mt-3">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Note:</strong> Employees must check in first before they can check out.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Status -->
            <div class="card stat-card mb-4">
                <div class="card-body">
                    <h5 class="mb-3">
                        <span class="badge bg-info me-2">3</span>
                        Understanding Attendance Status
                    </h5>
                    <div class="ms-4">
                        <table class="table table-bordered">
                            <tr>
                                <td><span class="badge bg-success">Present</span></td>
                                <td>Employee checked in on time (before or at 08:00)</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-warning">Late</span></td>
                                <td>Employee checked in after 08:00</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-danger">Absent</span></td>
                                <td>No attendance record for the day</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-info">Leave</span></td>
                                <td>Employee on approved leave</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Viewing Attendance Records -->
            <div class="card stat-card mb-4">
                <div class="card-body">
                    <h5 class="mb-3">
                        <span class="badge bg-secondary me-2">4</span>
                        Viewing Attendance Records
                    </h5>
                    <div class="ms-4">
                        <p class="text-muted">To view attendance history:</p>
                        <ol class="text-muted">
                            <li>Go to the <strong>Attendance</strong> menu</li>
                            <li>Use the filters to search by date, status, or employee</li>
                            <li>View the attendance records in the table</li>
                            <li>Click the <i class="fas fa-eye"></i> button to see details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Quick Stats -->
            <div class="card stat-card mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Today's Summary</h6>
                </div>
                <div class="card-body">
                    @php
                        $todayPresent = App\Models\Attendance::whereDate('date', today())
                            ->whereIn('status', ['present', 'late'])->count();
                        $totalEmployees = App\Models\Employee::where('status', 'active')->count();
                    @endphp
                    <div class="text-center mb-3">
                        <h3>{{ $todayPresent }}/{{ $totalEmployees }}</h3>
                        <p class="text-muted">Employees present today</p>
                    </div>
                </div>
            </div>

            <!-- Related Articles -->
            <div class="card stat-card">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Related Articles</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('help.employee-guide') }}" class="text-decoration-none">
                                <i class="fas fa-arrow-right text-primary me-2"></i>
                                Employee Management
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('help.reports-guide') }}" class="text-decoration-none">
                                <i class="fas fa-arrow-right text-primary me-2"></i>
                                Reports Guide
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('help.faq') }}" class="text-decoration-none">
                                <i class="fas fa-arrow-right text-primary me-2"></i>
                                FAQ
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection