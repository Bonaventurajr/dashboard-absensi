@extends('layouts.app')

@section('title', 'Frequently Asked Questions')

@section('content')
<div class="container-fluid px-0">
    <!-- Page Header -->
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
                                <i class="fas fa-question-circle text-danger me-2"></i>
                                Frequently Asked Questions
                            </h4>
                            <p class="text-muted mb-0">Find answers to common questions about the attendance system</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search FAQ -->
    <div class="card stat-card mb-4">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" id="searchFAQ" 
                               placeholder="Search FAQ...">
                        <button class="btn btn-primary" onclick="searchFAQ()">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Categories -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#general" class="list-group-item list-group-item-action active" data-bs-toggle="list">
                    <i class="fas fa-globe me-2"></i> General
                </a>
                <a href="#employees" class="list-group-item list-group-item-action" data-bs-toggle="list">
                    <i class="fas fa-users me-2"></i> Employees
                </a>
                <a href="#attendance" class="list-group-item list-group-item-action" data-bs-toggle="list">
                    <i class="fas fa-calendar-check me-2"></i> Attendance
                </a>
                <a href="#reports" class="list-group-item list-group-item-action" data-bs-toggle="list">
                    <i class="fas fa-chart-bar me-2"></i> Reports
                </a>
                <a href="#technical" class="list-group-item list-group-item-action" data-bs-toggle="list">
                    <i class="fas fa-cog me-2"></i> Technical
                </a>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="tab-content">
                <!-- General FAQ -->
                <div class="tab-pane active" id="general">
                    <div class="card stat-card">
                        <div class="card-header bg-white">
                            <h6 class="mb-0">General Questions</h6>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="generalAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#general1">
                                            What is Absensi System?
                                        </button>
                                    </h2>
                                    <div id="general1" class="accordion-collapse collapse show" data-bs-parent="#generalAccordion">
                                        <div class="accordion-body">
                                            Absensi System is a web-based employee attendance management system that helps organizations track and manage employee attendance, generate reports, and streamline HR processes.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#general2">
                                            How do I access the system?
                                        </button>
                                    </h2>
                                    <div id="general2" class="accordion-collapse collapse" data-bs-parent="#generalAccordion">
                                        <div class="accordion-body">
                                            You can access the system through your web browser at the provided URL. Login with your email and password provided by your administrator.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#general3">
                                            What should I do if I forget my password?
                                        </button>
                                    </h2>
                                    <div id="general3" class="accordion-collapse collapse" data-bs-parent="#generalAccordion">
                                        <div class="accordion-body">
                                            Click on the "Forgot Password" link on the login page and follow the instructions to reset your password. If you continue having issues, contact your system administrator.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Employees FAQ -->
                <div class="tab-pane" id="employees">
                    <div class="card stat-card">
                        <div class="card-header bg-white">
                            <h6 class="mb-0">Employee Management</h6>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="employeeAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#employee1">
                                            How do I add a new employee?
                                        </button>
                                    </h2>
                                    <div id="employee1" class="accordion-collapse collapse show" data-bs-parent="#employeeAccordion">
                                        <div class="accordion-body">
                                            <ol class="mb-0">
                                                <li>Go to the <strong>Employees</strong> menu in the sidebar</li>
                                                <li>Click the <span class="badge bg-primary">Add New Employee</span> button</li>
                                                <li>Fill in the required information (name, email, position, department)</li>
                                                <li>Click <span class="badge bg-success">Save Employee</span> to complete</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#employee2">
                                            How do I edit employee information?
                                        </button>
                                    </h2>
                                    <div id="employee2" class="accordion-collapse collapse" data-bs-parent="#employeeAccordion">
                                        <div class="accordion-body">
                                            <ol class="mb-0">
                                                <li>Go to the <strong>Employees</strong> list</li>
                                                <li>Find the employee you want to edit</li>
                                                <li>Click the <i class="fas fa-edit text-warning"></i> edit button</li>
                                                <li>Update the information and click <span class="badge bg-primary">Update Employee</span></li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#employee3">
                                            How do I deactivate an employee?
                                        </button>
                                    </h2>
                                    <div id="employee3" class="accordion-collapse collapse" data-bs-parent="#employeeAccordion">
                                        <div class="accordion-body">
                                            You can change an employee's status to "Inactive" in the edit form. This will prevent them from recording attendance while preserving their historical data.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Attendance FAQ -->
                <div class="tab-pane" id="attendance">
                    <div class="card stat-card">
                        <div class="card-header bg-white">
                            <h6 class="mb-0">Attendance Management</h6>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="attendanceAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#attendance1">
                                            How do I record check-in?
                                        </button>
                                    </h2>
                                    <div id="attendance1" class="accordion-collapse collapse show" data-bs-parent="#attendanceAccordion">
                                        <div class="accordion-body">
                                            <ol class="mb-0">
                                                <li>Click the <span class="badge bg-primary">Check In</span> button on the Dashboard or Attendance page</li>
                                                <li>Select the employee from the dropdown</li>
                                                <li>Optional: Take a photo for verification</li>
                                                <li>Click <span class="badge bg-primary">Check In</span> to confirm</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#attendance2">
                                            How do I record check-out?
                                        </button>
                                    </h2>
                                    <div id="attendance2" class="accordion-collapse collapse" data-bs-parent="#attendanceAccordion">
                                        <div class="accordion-body">
                                            <ol class="mb-0">
                                                <li>Click the <span class="badge bg-success">Check Out</span> button</li>
                                                <li>Select the employee who is checking out</li>
                                                <li>Optional: Take a photo for verification</li>
                                                <li>Click <span class="badge bg-success">Check Out</span> to confirm</li>
                                            </ol>
                                            <p class="text-warning mt-2 mb-0">
                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                Note: Employees must check in first before they can check out.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#attendance3">
                                            What do the attendance statuses mean?
                                        </button>
                                    </h2>
                                    <div id="attendance3" class="accordion-collapse collapse" data-bs-parent="#attendanceAccordion">
                                        <div class="accordion-body">
                                            <table class="table table-sm">
                                                <tr>
                                                    <td><span class="badge bg-success">Present</span></td>
                                                    <td>Checked in on time (before or at 08:00)</td>
                                                </tr>
                                                <tr>
                                                    <td><span class="badge bg-warning">Late</span></td>
                                                    <td>Checked in after 08:00</td>
                                                </tr>
                                                <tr>
                                                    <td><span class="badge bg-danger">Absent</span></td>
                                                    <td>No attendance record for the day</td>
                                                </tr>
                                                <tr>
                                                    <td><span class="badge bg-info">Leave</span></td>
                                                    <td>On approved leave</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Reports FAQ -->
                <div class="tab-pane" id="reports">
                    <div class="card stat-card">
                        <div class="card-header bg-white">
                            <h6 class="mb-0">Reports & Analytics</h6>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="reportsAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#reports1">
                                            How do I generate attendance reports?
                                        </button>
                                    </h2>
                                    <div id="reports1" class="accordion-collapse collapse show" data-bs-parent="#reportsAccordion">
                                        <div class="accordion-body">
                                            <ol class="mb-0">
                                                <li>Go to the <strong>Reports</strong> menu</li>
                                                <li>Select date range (start and end date)</li>
                                                <li>Optional: Filter by department or employee</li>
                                                <li>Click <span class="badge bg-primary">Generate Report</span></li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#reports2">
                                            How do I export reports to PDF?
                                        </button>
                                    </h2>
                                    <div id="reports2" class="accordion-collapse collapse" data-bs-parent="#reportsAccordion">
                                        <div class="accordion-body">
                                            After generating your report, click the <span class="badge bg-danger">Export PDF</span> button. The report will be downloaded as a PDF file.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#reports3">
                                            Can I get reports for individual employees?
                                        </button>
                                    </h2>
                                    <div id="reports3" class="accordion-collapse collapse" data-bs-parent="#reportsAccordion">
                                        <div class="accordion-body">
                                            Yes, use the employee filter in the reports page to generate reports for specific employees, or click on an employee's name in the employees list to see their individual attendance history.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Technical FAQ -->
                <div class="tab-pane" id="technical">
                    <div class="card stat-card">
                        <div class="card-header bg-white">
                            <h6 class="mb-0">Technical Issues</h6>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="technicalAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#tech1">
                                            What browsers are supported?
                                        </button>
                                    </h2>
                                    <div id="tech1" class="accordion-collapse collapse show" data-bs-parent="#technicalAccordion">
                                        <div class="accordion-body">
                                            The system supports all modern browsers including Google Chrome, Mozilla Firefox, Microsoft Edge, and Safari.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#tech2">
                                            Why can't I log in?
                                        </button>
                                    </h2>
                                    <div id="tech2" class="accordion-collapse collapse" data-bs-parent="#technicalAccordion">
                                        <div class="accordion-body">
                                            Common login issues:
                                            <ul class="mb-0 mt-2">
                                                <li>Check if Caps Lock is on</li>
                                                <li>Ensure you're using the correct email and password</li>
                                                <li>Clear your browser cache and cookies</li>
                                                <li>Contact your administrator if the problem persists</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#tech3">
                                            How do I contact technical support?
                                        </button>
                                    </h2>
                                    <div id="tech3" class="accordion-collapse collapse" data-bs-parent="#technicalAccordion">
                                        <div class="accordion-body">
                                            You can contact technical support through:
                                            <ul class="mb-0 mt-2">
                                                <li>Email: support@absensisystem.com</li>
                                                <li>Phone: +62 21 1234 5678</li>
                                                <li>Submit a ticket through the <a href="{{ route('help.contact') }}">Contact Support</a> page</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Still Have Questions -->
    <div class="card stat-card bg-primary text-white">
        <div class="card-body text-center py-4">
            <h5 class="mb-3">Still Have Questions?</h5>
            <p class="mb-3">Can't find what you're looking for? Our support team is here to help.</p>
            <a href="{{ route('help.contact') }}" class="btn btn-light">
                <i class="fas fa-headset me-2"></i>Contact Support
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function searchFAQ() {
    var searchTerm = document.getElementById('searchFAQ').value.toLowerCase();
    
    if (searchTerm.length < 3) {
        alert('Please enter at least 3 characters to search.');
        return;
    }
    
    // Simple search implementation
    var accordions = document.querySelectorAll('.accordion-button');
    var found = false;
    
    accordions.forEach(function(button) {
        var text = button.textContent.toLowerCase();
        var collapse = document.querySelector(button.getAttribute('data-bs-target'));
        
        if (text.includes(searchTerm)) {
            button.classList.remove('collapsed');
            if (collapse) collapse.classList.add('show');
            found = true;
        } else {
            button.classList.add('collapsed');
            if (collapse) collapse.classList.remove('show');
        }
    });
    
    if (!found) {
        alert('No results found for "' + searchTerm + '". Try different keywords.');
    }
}

// Enter key search
document.getElementById('searchFAQ').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        searchFAQ();
    }
});
</script>
@endpush