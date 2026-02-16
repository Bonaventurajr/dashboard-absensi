@extends('layouts.app')

@section('title', 'Employee Report - ' . $employee->name)

@section('content')
<div class="container-fluid px-0">
    <!-- Similar to index but filtered for specific employee -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        @if($employee->photo)
                            <img src="{{ asset($employee->photo) }}" 
                                 class="rounded-circle me-3" width="60" height="60">
                        @else
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-user fa-2x text-white"></i>
                            </div>
                        @endif
                        <div>
                            <h4 class="mb-1">{{ $employee->name }}</h4>
                            <p class="text-muted mb-0">
                                {{ $employee->employee_id }} | {{ $employee->position }} | {{ $employee->department }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics and table similar to reports.index -->
    <!-- ... -->
</div>
@endsection