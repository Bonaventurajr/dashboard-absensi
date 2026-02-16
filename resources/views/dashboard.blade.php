@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-0">
   <!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card stat-card" style="background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="text-dark mb-2">Welcome back, Admin!</h4>
                        <p class="text-secondary mb-0">Here's what's happening with your attendance today.</p>
                    </div>
                    <div class="text-primary">
                        <i class="fas fa-sun fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <!-- Statistics Cards -->
    <div class="row mb-4 g-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted text-uppercase small">Total Employees</span>
                            <h2 class="mb-0 mt-2">{{ $totalEmployees }}</h2>
                            <small class="text-success">
                                <i class="fas fa-arrow-up me-1"></i>Active employees
                            </small>
                        </div>
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted text-uppercase small">Present Today</span>
                            <h2 class="mb-0 mt-2">{{ $presentToday }}</h2>
                            <small class="text-success">
                                <i class="fas fa-check-circle me-1"></i>{{ $presentToday }} employees
                            </small>
                        </div>
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted text-uppercase small">Late Today</span>
                            <h2 class="mb-0 mt-2">{{ $lateToday }}</h2>
                            <small class="text-warning">
                                <i class="fas fa-clock me-1"></i>{{ $lateToday }} employees late
                            </small>
                        </div>
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted text-uppercase small">Not Checked Out</span>
                            <h2 class="mb-0 mt-2">{{ $notCheckedOut }}</h2>
                            <small class="text-danger">
                                <i class="fas fa-sign-out-alt me-1"></i>Pending checkouts
                            </small>
                        </div>
                        <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Chart and Quick Actions -->
    <div class="row mb-4 g-4">
        <div class="col-xl-8">
            <div class="card stat-card">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-line me-2 text-primary"></i>
                            Attendance Overview (7 Days)
                        </h5>
                        <div>
                            <span class="badge bg-primary">This Week</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="attendanceChart" height="300"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4">
            <div class="card stat-card">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt me-2 text-warning"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <button class="btn btn-primary w-100 mb-3 py-3" data-bs-toggle="modal" data-bs-target="#checkInModal">
                        <i class="fas fa-sign-in-alt me-2"></i>Check In
                    </button>
                    <button class="btn btn-success w-100 mb-3 py-3" data-bs-toggle="modal" data-bs-target="#checkOutModal">
                        <i class="fas fa-sign-out-alt me-2"></i>Check Out
                    </button>
                    <a href="{{ route('employees.create') }}" class="btn btn-info w-100 py-3 text-white">
                        <i class="fas fa-user-plus me-2"></i>Add New Employee
                    </a>
                </div>
            </div>
            
            <!-- Summary Card -->
            <div class="card stat-card mt-4">
                <div class="card-body">
                    <h6 class="text-muted mb-3">Today's Summary</h6>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Present</span>
                        <span class="fw-bold">{{ $presentToday }}</span>
                    </div>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: {{ $totalEmployees > 0 ? ($presentToday/$totalEmployees)*100 : 0 }}%"></div>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Late</span>
                        <span class="fw-bold">{{ $lateToday }}</span>
                    </div>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-warning" role="progressbar" 
                             style="width: {{ $totalEmployees > 0 ? ($lateToday/$totalEmployees)*100 : 0 }}%"></div>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Absent</span>
                        <span class="fw-bold">{{ $absentToday }}</span>
                    </div>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-danger" role="progressbar" 
                             style="width: {{ $totalEmployees > 0 ? ($absentToday/$totalEmployees)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Attendances -->
    <div class="card stat-card">
        <div class="card-header bg-white border-0 pt-4 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-history me-2 text-info"></i>
                    Recent Attendance Records
                </h5>
                <a href="{{ route('attendances.index') }}" class="btn btn-sm btn-outline-primary">
                    View All <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>
                            <th>Working Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentAttendances as $attendance)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($attendance->employee->photo)
                                        <img src="{{ asset($attendance->employee->photo) }}" 
                                             alt="{{ $attendance->employee->name }}" 
                                             class="rounded-circle me-2" width="35" height="35" style="object-fit: cover;">
                                    @else
                                        <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center me-2" 
                                             style="width: 35px; height: 35px;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-bold">{{ $attendance->employee->name }}</div>
                                        <small class="text-muted">{{ $attendance->employee->position }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $attendance->date->format('d M Y') }}</td>
                            <td>
                                @if($attendance->check_in)
                                    <span class="fw-bold">{{ $attendance->check_in->format('H:i') }}</span>
                                    <br>
                                    <small class="text-muted">{{ $attendance->check_in->format('d M') }}</small>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($attendance->check_out)
                                    <span class="fw-bold">{{ $attendance->check_out->format('H:i') }}</span>
                                    <br>
                                    <small class="text-muted">{{ $attendance->check_out->format('d M') }}</small>
                                @else
                                    <span class="badge bg-warning">Not yet</span>
                                @endif
                            </td>
                            <td>
                                @if($attendance->status == 'present')
                                    <span class="badge bg-success">Present</span>
                                @elseif($attendance->status == 'late')
                                    <span class="badge bg-warning">Late</span>
                                @elseif($attendance->status == 'absent')
                                    <span class="badge bg-danger">Absent</span>
                                @else
                                    <span class="badge bg-info">{{ $attendance->status }}</span>
                                @endif
                            </td>
                            <td>
                                @if($attendance->check_in && $attendance->check_out)
                                    @php
                                        $checkIn = \Carbon\Carbon::parse($attendance->check_in);
                                        $checkOut = \Carbon\Carbon::parse($attendance->check_out);
                                        $hours = $checkIn->diffInHours($checkOut);
                                        $minutes = $checkIn->diffInMinutes($checkOut) % 60;
                                    @endphp
                                    <span class="fw-bold">{{ $hours }}h {{ $minutes }}m</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                                <h6 class="text-muted">No attendance records found</h6>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Include Modals -->
@if(isset($activeEmployees))
    @include('partials.checkin-modal')
    @include('partials.checkout-modal')
@else
    @php
        $activeEmployees = App\Models\Employee::where('status', 'active')->get();
    @endphp
    @include('partials.checkin-modal')
    @include('partials.checkout-modal')
@endif
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('attendanceChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($dates) !!},
            datasets: [{
                label: 'Total Attendance',
                data: {!! json_encode($attendanceCounts) !!},
                borderColor: 'rgb(102, 126, 234)',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: 'rgb(102, 126, 234)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        callback: function(value) {
                            return value + ' people';
                        }
                    },
                    grid: {
                        display: true,
                        color: 'rgba(0,0,0,0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endpush