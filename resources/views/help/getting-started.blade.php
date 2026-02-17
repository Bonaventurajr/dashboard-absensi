@extends('layouts.app')

@section('title', 'Getting Started')

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
                                <i class="fas fa-rocket text-primary me-2"></i>
                                Getting Started Guide
                            </h4>
                            <p class="text-muted mb-0">Learn the basics of using the attendance system</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card stat-card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="mb-4">Step-by-Step Guide</h5>
                    
                    <div class="mb-4">
                        <h6><span class="badge bg-primary me-2">1</span> Add Employees</h6>
                        <p class="text-muted ms-4">Go to Employees menu and click "Add New Employee". Fill in the required information including name, email, position, and department. Upload a photo if available.</p>
                    </div>
                    
                    <div class="mb-4">
                        <h6><span class="badge bg-primary me-2">2</span> Configure Settings</h6>
                        <p class="text-muted ms-4">Navigate to Settings to set up your attendance rules. Define check-in/check-out times, late threshold, and notification preferences.</p>
                    </div>
                    
                    <div class="mb-4">
                        <h6><span class="badge bg-primary me-2">3</span> Record Attendance</h6>
                        <p class="text-muted ms-4">Use the Dashboard or Attendance page to record daily check-ins and check-outs. You can also add notes or photos for verification.</p>
                    </div>
                    
                    <div class="mb-4">
                        <h6><span class="badge bg-primary me-2">4</span> Generate Reports</h6>
                        <p class="text-muted ms-4">Visit the Reports page to view attendance summaries, export data to PDF or Excel, and analyze attendance patterns.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="bg-light p-4 rounded">
                        <h6 class="mb-3">Quick Tips</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-lightbulb text-warning me-2"></i>
                                Use the quick actions on dashboard
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-lightbulb text-warning me-2"></i>
                                Filter attendance by date range
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-lightbulb text-warning me-2"></i>
                                Check status badges for quick info
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection