@extends('layouts.app')

@section('title', 'Attendance Reports')

@section('content')
<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="text-dark mb-2">
                                <i class="fas fa-chart-bar text-primary me-2"></i>
                                Attendance Reports
                            </h4>
                            <p class="text-muted mb-0">Generate and analyze attendance reports</p>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-danger" onclick="exportPDF()">
                                <i class="fas fa-file-pdf me-2"></i>Export PDF
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card stat-card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('reports.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Department</label>
                    <select name="department" class="form-control">
                        <option value="">All Departments</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept }}" {{ $department == $dept ? 'selected' : '' }}>
                                {{ $dept }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="present" {{ $status == 'present' ? 'selected' : '' }}>Present</option>
                        <option value="late" {{ $status == 'late' ? 'selected' : '' }}>Late</option>
                        <option value="absent" {{ $status == 'absent' ? 'selected' : '' }}>Absent</option>
                        <option value="leave" {{ $status == 'leave' ? 'selected' : '' }}>Leave</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Employee</label>
                    <select name="employee_id" class="form-control">
                        <option value="">All Employees</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" {{ $employeeId == $emp->id ? 'selected' : '' }}>
                                {{ $emp->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter me-2"></i>Generate Report
                    </button>
                    <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                        <i class="fas fa-redo me-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4 g-4">
        <div class="col-md-3">
            <div class="card stat-card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50">Total Days</h6>
                            <h3 class="text-white mb-0">{{ $statistics['total_days'] }}</h3>
                        </div>
                        <i class="fas fa-calendar fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50">Present</h6>
                            <h3 class="text-white mb-0">{{ $statistics['present'] }}</h3>
                        </div>
                        <i class="fas fa-check-circle fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50">Late</h6>
                            <h3 class="text-white mb-0">{{ $statistics['late'] }}</h3>
                        </div>
                        <i class="fas fa-clock fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50">Absent</h6>
                            <h3 class="text-white mb-0">{{ $statistics['absent'] }}</h3>
                        </div>
                        <i class="fas fa-times-circle fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4 g-4">
        <div class="col-md-8">
            <div class="card stat-card">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Monthly Trend</h6>
                </div>
                <div class="card-body">
                    <canvas id="monthlyChart" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Status Distribution</h6>
                </div>
                <div class="card-body">
                    <canvas id="statusChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Employees -->
    <div class="card stat-card mb-4">
        <div class="card-header bg-white">
            <h6 class="mb-0">Top Employees by Attendance</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Present</th>
                            <th>Attendance Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topEmployees as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($item->employee->photo)
                                        <img src="{{ asset($item->employee->photo) }}" 
                                             class="rounded-circle me-2" width="30" height="30">
                                    @else
                                        <div class="bg-secondary rounded-circle me-2" 
                                             style="width: 30px; height: 30px;"></div>
                                    @endif
                                    {{ $item->employee->name }}
                                </div>
                            </td>
                            <td>{{ $item->employee->department }}</td>
                            <td>{{ $item->present_count }}/{{ $statistics['total_days'] }}</td>
                            <td>
                                @php
                                    $rate = $statistics['total_days'] > 0 ? 
                                            round(($item->present_count / $statistics['total_days']) * 100) : 0;
                                @endphp
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar bg-success" 
                                         style="width: {{ $rate }}%">
                                        {{ $rate }}%
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Detailed Report Table -->
    <div class="card stat-card">
        <div class="card-header bg-white">
            <h6 class="mb-0">Detailed Attendance Report</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="reportTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>
                            <th>Working Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->date->format('d M Y') }}</td>
                            <td>{{ $attendance->employee->name }}</td>
                            <td>{{ $attendance->employee->department }}</td>
                            <td>{{ $attendance->check_in ? $attendance->check_in->format('H:i') : '-' }}</td>
                            <td>{{ $attendance->check_out ? $attendance->check_out->format('H:i') : '-' }}</td>
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
                                        $hours = $attendance->check_in->diffInHours($attendance->check_out);
                                        $minutes = $attendance->check_in->diffInMinutes($attendance->check_out) % 60;
                                    @endphp
                                    {{ $hours }}h {{ $minutes }}m
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fas fa-chart-bar fa-4x text-muted mb-3"></i>
                                <h6 class="text-muted">No data available for selected filters</h6>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Monthly Trend Chart
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($monthlyTrend->pluck('month')->map(function($m) {
                return Carbon\Carbon::create()->month($m)->format('F');
            })) !!},
            datasets: [{
                label: 'Present',
                data: {!! json_encode($monthlyTrend->pluck('present')) !!},
                borderColor: '#28a745',
                backgroundColor: 'rgba(40, 167, 69, 0.1)',
                tension: 0.4
            }, {
                label: 'Late',
                data: {!! json_encode($monthlyTrend->pluck('late')) !!},
                borderColor: '#ffc107',
                backgroundColor: 'rgba(255, 193, 7, 0.1)',
                tension: 0.4
            }, {
                label: 'Absent',
                data: {!! json_encode($monthlyTrend->pluck('absent')) !!},
                borderColor: '#dc3545',
                backgroundColor: 'rgba(220, 53, 69, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Status Distribution Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Present', 'Late', 'Absent', 'Leave'],
            datasets: [{
                data: [
                    {{ $statistics['present'] }},
                    {{ $statistics['late'] }},
                    {{ $statistics['absent'] }},
                    {{ $statistics['leave'] }}
                ],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545', '#17a2b8'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    function exportPDF() {
        window.location.href = '{{ route("reports.export-pdf") }}' + window.location.search;
    }

    function exportExcel() {
        window.location.href = '{{ route("reports.export-excel") }}' + window.location.search;
    }
</script>
@endpush