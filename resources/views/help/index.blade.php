@extends('layouts.app')

@section('title', 'Help Center')

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
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                Help Center
                            </h4>
                            <p class="text-muted mb-0">Find answers to your questions and learn how to use the system</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="row mb-4 g-4">
        <div class="col-md-4">
            <a href="{{ route('help.getting-started') }}" class="text-decoration-none">
                <div class="card stat-card h-100">
                    <div class="card-body text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                            <i class="fas fa-rocket fa-3x text-primary"></i>
                        </div>
                        <h5>Getting Started</h5>
                        <p class="text-muted small">New to the system? Start here</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('help.employee-guide') }}" class="text-decoration-none">
                <div class="card stat-card h-100">
                    <div class="card-body text-center">
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                            <i class="fas fa-users fa-3x text-success"></i>
                        </div>
                        <h5>Employee Management</h5>
                        <p class="text-muted small">Learn how to manage employees</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('help.attendance-guide') }}" class="text-decoration-none">
                <div class="card stat-card h-100">
                    <div class="card-body text-center">
                        <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                            <i class="fas fa-calendar-check fa-3x text-warning"></i>
                        </div>
                        <h5>Attendance Guide</h5>
                        <p class="text-muted small">How to record and manage attendance</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('help.reports-guide') }}" class="text-decoration-none">
                <div class="card stat-card h-100">
                    <div class="card-body text-center">
                        <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                            <i class="fas fa-chart-bar fa-3x text-info"></i>
                        </div>
                        <h5>Reports Guide</h5>
                        <p class="text-muted small">Generate and analyze reports</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('help.faq') }}" class="text-decoration-none">
                <div class="card stat-card h-100">
                    <div class="card-body text-center">
                        <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                            <i class="fas fa-question fa-3x text-danger"></i>
                        </div>
                        <h5>FAQ</h5>
                        <p class="text-muted small">Frequently asked questions</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('help.contact') }}" class="text-decoration-none">
                <div class="card stat-card h-100">
                    <div class="card-body text-center">
                        <div class="bg-secondary bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                            <i class="fas fa-headset fa-3x text-secondary"></i>
                        </div>
                        <h5>Contact Support</h5>
                        <p class="text-muted small">Get help from our team</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="card stat-card mb-4">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" 
                               placeholder="Search for help articles...">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Topics -->
    <div class="card stat-card">
        <div class="card-header bg-white">
            <h6 class="mb-0">Popular Topics</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <a href="#" class="text-decoration-none">How to add new employee</a>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <a href="#" class="text-decoration-none">Recording daily attendance</a>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <a href="#" class="text-decoration-none">Generating monthly reports</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <a href="#" class="text-decoration-none">Understanding attendance status</a>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <a href="#" class="text-decoration-none">Exporting data to Excel</a>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <a href="#" class="text-decoration-none">Troubleshooting common issues</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection