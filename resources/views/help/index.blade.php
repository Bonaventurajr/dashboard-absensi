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
                            <p class="text-muted mb-0">Find answers and learn how to use the system</p>
                        </div>
                        <div class="text-primary">
                            <i class="fas fa-headset fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
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
                               placeholder="Search for help articles..." id="searchHelp">
                        <button class="btn btn-primary" onclick="searchHelp()">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Help Categories -->
    <div class="row g-4">
        <div class="col-md-4">
            <a href="{{ route('help.getting-started') }}" class="text-decoration-none">
                <div class="card stat-card h-100">
                    <div class="card-body text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                            <i class="fas fa-rocket fa-3x text-primary"></i>
                        </div>
                        <h5>Getting Started</h5>
                        <p class="text-muted">New to the system? Start here</p>
                        <span class="badge bg-primary">Beginner</span>
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
                        <p class="text-muted">Manage employee data</p>
                        <span class="badge bg-success">Guide</span>
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
                        <p class="text-muted">Record and manage attendance</p>
                        <span class="badge bg-warning text-dark">Tutorial</span>
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
                        <p class="text-muted">Generate and analyze reports</p>
                        <span class="badge bg-info">Advanced</span>
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
                        <p class="text-muted">Frequently asked questions</p>
                        <span class="badge bg-danger">Popular</span>
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
                        <p class="text-muted">Get help from our team</p>
                        <span class="badge bg-secondary">24/7</span>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Popular Topics -->
    <div class="card stat-card mt-4">
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

@push('scripts')
<script>
function searchHelp() {
    var searchTerm = document.getElementById('searchHelp').value;
    if(searchTerm) {
        alert('Searching for: ' + searchTerm + ' (Feature coming soon)');
    } else {
        alert('Please enter a search term');
    }
}
</script>
@endpush
@endsection