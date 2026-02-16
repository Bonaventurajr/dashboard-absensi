@extends('layouts.app')

@section('title', 'Attendance Records')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Attendance Records</h2>
        <div>
            <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#checkInModal">
                <i class="fas fa-sign-in-alt me-2"></i>Check In
            </button>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#checkOutModal">
                <i class="fas fa-sign-out-alt me-2"></i>Check Out
            </button>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card stat-card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('attendances.index') }}" class="row">
                <div class="col-md-4">
                    <label for="date" class="form-label">Filter by Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ request('date', date('Y-m-d')) }}">
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label">Filter by Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="">All Status</option>
                        <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>Present</option>
                        <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Late</option>
                        <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                        <option value="leave" {{ request('status') == 'leave' ? 'selected' : '' }}>Leave</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                    <a href="{{ route('attendances.index') }}" class="btn btn-secondary">
                        <i class="fas fa-redo me-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Attendance Table -->
    <div class="card stat-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Employee ID</th>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>
                            <th>Working Hours</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $attendance)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($attendance->employee->photo)
                                        <img src="{{ asset($attendance->employee->photo) }}" 
                                             alt="{{ $attendance->employee->name }}" 
                                             class="rounded-circle me-2" width="30" height="30" style="object-fit: cover;">
                                    @else
                                        <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center me-2" 
                                             style="width: 30px; height: 30px;">
                                            <i class="fas fa-user text-white small"></i>
                                        </div>
                                    @endif
                                    {{ $attendance->employee->name }}
                                </div>
                            </td>
                            <td><span class="badge bg-info">{{ $attendance->employee->employee_id }}</span></td>
                            <td>{{ $attendance->date->format('d M Y') }}</td>
                            <td>
                                @if($attendance->check_in)
                                    {{ $attendance->check_in->format('H:i:s') }}
                                    @if($attendance->photo_in)
                                        <i class="fas fa-camera text-info ms-1" title="Photo available"></i>
                                    @endif
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($attendance->check_out)
                                    {{ $attendance->check_out->format('H:i:s') }}
                                    @if($attendance->photo_out)
                                        <i class="fas fa-camera text-info ms-1" title="Photo available"></i>
                                    @endif
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($attendance->status == 'present')
                                    <span class="badge bg-success">Present</span>
                                @elseif($attendance->status == 'late')
                                    <span class="badge bg-warning">Late</span>
                                @elseif($attendance->status == 'absent')
                                    <span class="badge bg-danger">Absent</span>
                                @elseif($attendance->status == 'leave')
                                    <span class="badge bg-info">Leave</span>
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
                                    {{ $hours }}h {{ $minutes }}m
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info" onclick="viewDetails({{ $attendance->id }})">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No attendance records found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $attendances->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Include Modals -->
@include('partials.checkin-modal')
@include('partials.checkout-modal')

@endsection

@push('scripts')
<script>
function viewDetails(id) {
    // Implement view details functionality
    alert('View details for attendance ID: ' + id);
}
</script>
@endpush