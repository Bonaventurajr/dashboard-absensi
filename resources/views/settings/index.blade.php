@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="container-fluid px-0">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body">
                    <h4 class="mb-2">
                        <i class="fas fa-cog text-primary me-2"></i>
                        Settings
                    </h4>
                    <p class="text-muted mb-0">Configure your application settings</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Navigation -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#general" class="list-group-item list-group-item-action active" data-bs-toggle="list">
                    <i class="fas fa-sliders-h me-2"></i> General
                </a>
                <a href="#attendance" class="list-group-item list-group-item-action" data-bs-toggle="list">
                    <i class="fas fa-clock me-2"></i> Attendance
                </a>
                <a href="#notifications" class="list-group-item list-group-item-action" data-bs-toggle="list">
                    <i class="fas fa-bell me-2"></i> Notifications
                </a>
                <a href="#backup" class="list-group-item list-group-item-action" data-bs-toggle="list">
                    <i class="fas fa-database me-2"></i> Backup
                </a>
                <a href="#users" class="list-group-item list-group-item-action" data-bs-toggle="list">
                    <i class="fas fa-users-cog me-2"></i> Users
                </a>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="tab-content">
                <!-- General Settings -->
                <div class="tab-pane active" id="general">
                    <div class="card stat-card">
                        <div class="card-body">
                            <h5 class="mb-4">General Settings</h5>
                            <form action="{{ route('settings.update.general') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Application Name</label>
                                    <input type="text" name="app_name" class="form-control" 
                                           value="{{ session('app_name', 'Absensi System') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" name="company_name" class="form-control" 
                                           value="{{ session('company_name', 'PT. Example Company') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Timezone</label>
                                    <select name="timezone" class="form-control">
                                        <option value="Asia/Jakarta">Asia/Jakarta (WIB)</option>
                                        <option value="Asia/Makassar">Asia/Makassar (WITA)</option>
                                        <option value="Asia/Jayapura">Asia/Jayapura (WIT)</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Date Format</label>
                                    <select name="date_format" class="form-control">
                                        <option value="Y-m-d">2024-12-31</option>
                                        <option value="d/m/Y">31/12/2024</option>
                                        <option value="m/d/Y">12/31/2024</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Attendance Settings -->
                <div class="tab-pane" id="attendance">
                    <div class="card stat-card">
                        <div class="card-body">
                            <h5 class="mb-4">Attendance Settings</h5>
                            <form action="{{ route('settings.update.attendance') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Check In Start Time</label>
                                        <input type="time" name="check_in_start" class="form-control" value="07:00">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Check In End Time</label>
                                        <input type="time" name="check_in_end" class="form-control" value="09:00">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Check Out Start Time</label>
                                        <input type="time" name="check_out_start" class="form-control" value="16:00">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Check Out End Time</label>
                                        <input type="time" name="check_out_end" class="form-control" value="18:00">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Late Threshold (minutes)</label>
                                        <input type="number" name="late_threshold" class="form-control" value="15">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Notifications Settings -->
                <div class="tab-pane" id="notifications">
                    <div class="card stat-card">
                        <div class="card-body">
                            <h5 class="mb-4">Notification Settings</h5>
                            <form action="{{ route('settings.update.notifications') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_notification" checked>
                                        <label class="form-check-label">Email Notifications</label>
                                    </div>
                                    <small class="text-muted">Receive attendance reports via email</small>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="whatsapp_notification">
                                        <label class="form-check-label">WhatsApp Notifications</label>
                                    </div>
                                    <small class="text-muted">Receive reminders via WhatsApp</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Reminder Time</label>
                                    <input type="time" name="reminder_time" class="form-control" value="07:30">
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Backup Settings -->
                <div class="tab-pane" id="backup">
                    <div class="card stat-card">
                        <div class="card-body">
                            <h5 class="mb-4">Backup & Restore</h5>
                            
                            <div class="mb-4">
                                <h6>Create Backup</h6>
                                <p class="text-muted small">Create a backup of your database</p>
                                <form action="{{ route('settings.backup.create') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-download me-2"></i>Create Backup
                                    </button>
                                </form>
                            </div>
                            
                            <hr>
                            
                            <div>
                                <h6>Restore Backup</h6>
                                <p class="text-muted small">Restore from a previous backup</p>
                                <form action="{{ route('settings.backup.restore') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="file" name="backup_file" class="form-control" accept=".sql,.zip">
                                    </div>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-upload me-2"></i>Restore Backup
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Users Management -->
                <div class="tab-pane" id="users">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="mb-0">User Management</h5>
                                <button class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-2"></i>Add User
                                </button>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection