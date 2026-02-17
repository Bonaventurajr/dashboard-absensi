@extends('layouts.app')

@section('title', 'Reports Guide')

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
                                <i class="fas fa-chart-bar text-info me-2"></i>
                                Reports Guide
                            </h4>
                            <p class="text-muted mb-0">Learn how to generate and analyze attendance reports</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Generating Reports -->
            <div class="card stat-card mb-4">
                <div class="card-body">
                    <h5 class="mb-3">
                        <span class="badge bg-primary me-2">1</span>
                        Generating Reports
                    </h5>
                    <div class="ms-4">
                        <p class="text-muted">To generate attendance reports:</p>
                        <ol class="text-muted">
                            <li>Navigate to the <strong>Reports</strong> menu</li>
                            <li>Use the filter options:
                                <ul>
                                    <li>Select <strong>Start Date</strong> and <strong>End Date</strong></li>
                                    <li>Filter by <strong>Department</strong> (optional)</li>
                                    <li>Filter by <strong>Status</strong> (optional)</li>
                                    <li>Filter by specific <strong>Employee</strong> (optional)</li>
                                </ul>
                            </li>
                            <li>Click <span class="badge bg-primary">Generate Report</span></li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Understanding Report Data -->
            <div class="card stat-card mb-4">
                <div class="card-body">
                    <h5 class="mb-3">
                        <span class="badge bg-success me-2">2</span>
                        Understanding Report Data
                    </h5>
                    <div class="ms-4">
                        <p class="text-muted">The report page shows:</p>
                        <ul class="text-muted">
                            <li><strong>Statistics Cards</strong> - Total days, present, late, and absent counts</li>
                            <li><strong>Monthly Trend Chart</strong> - Attendance patterns over time</li>
                            <li><strong>Status Distribution Chart</strong> - Breakdown by attendance status</li>
                            <li><strong>Top Employees</strong> - Best attendance records</li>
                            <li><strong>Detailed Table</strong> - Complete attendance data</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Exporting Reports -->
            <div class="card stat-card mb-4">
                <div class="card-body">
                    <h5 class="mb-3">
                        <span class="badge bg-warning me-2">3</span>
                        Exporting Reports
                    </h5>
                    <div class="ms-4">
                        <p class="text-muted">To export report data:</p>
                        <ol class="text-muted">
                            <li>Generate your report first</li>
                            <li>Click <span class="badge bg-success">Export Excel</span> for spreadsheet format</li>
                            <li>Click <span class="badge bg-danger">Export PDF</span> for document format</li>
                        </ol>
                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle me-2"></i>
                            Exported files will include all filtered data with date range information.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Report Types -->
            <div class="card stat-card mb-4">
                <div class="card-body">
                    <h5 class="mb-3">
                        <span class="badge bg-info me-2">4</span>
                        Report Types
                    </h5>
                    <div class="ms-4">
                        <ul class="text-muted">
                            <li><strong>Daily Report</strong> - Attendance for a specific day</li>
                            <li><strong>Monthly Summary</strong> - Overview of monthly attendance</li>
                            <li><strong>Employee Report</strong> - Individual employee attendance history</li>
                            <li><strong>Department Report</strong> - Attendance by department</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Quick Tips -->
            <div class="card stat-card mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Quick Tips</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Use date filters to focus on specific periods
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Export data for further analysis
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Compare attendance across departments
                        </li>
                    </ul>
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
                            <a href="{{ route('help.attendance-guide') }}" class="text-decoration-none">
                                <i class="fas fa-arrow-right text-primary me-2"></i>
                                Attendance Guide
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