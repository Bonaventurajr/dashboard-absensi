<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Absensi')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            overflow-x: hidden;
        }

        /* Wrapper untuk sidebar dan konten */
        .wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* Sidebar styling */
        .sidebar {
            width: 280px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transition: all 0.3s;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .sidebar .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar .sidebar-header h3 {
            margin: 0;
            font-weight: 600;
            font-size: 1.5rem;
            letter-spacing: 1px;
        }

        .sidebar .sidebar-header p {
            margin: 5px 0 0;
            font-size: 0.85rem;
            opacity: 0.8;
        }

        .sidebar .nav-menu {
            padding: 20px 0;
        }

        .sidebar .nav-item {
            margin: 5px 15px;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            border-radius: 10px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }

        .sidebar .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.15);
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .sidebar .nav-link i {
            width: 24px;
            font-size: 1.2rem;
            text-align: center;
        }

        /* Konten utama */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 25px 30px;
            background-color: #f8f9fa;
            min-height: 100vh;
            transition: all 0.3s;
        }

        /* ============================================ */
        /* TOP NAVBAR STYLING */
        /* ============================================ */
        .top-navbar {
            background: white;
            padding: 15px 25px;
            border-radius: 15px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 20px;
            z-index: 99;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255,255,255,0.2);
        }

        /* Page Title */
        .page-title h4 {
            margin: 0;
            font-weight: 600;
            color: #333;
            font-size: 1.5rem;
        }

        .page-title span {
            font-size: 0.9rem;
            color: #6c757d;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 3px;
        }

        .page-title span i {
            font-size: 0.8rem;
            color: #667eea;
        }

        /* User Info Container */
        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* Notification Bell */
        .notification {
            position: relative;
            cursor: pointer;
            padding: 8px;
            border-radius: 10px;
            transition: all 0.3s;
            background: #f8f9fa;
        }

        .notification:hover {
            background: #e9ecef;
        }

        .notification i {
            font-size: 1.3rem;
            color: #495057;
        }

        .notification .badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.65rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }

        /* User Profile Dropdown */
        .user-profile {
            position: relative;
        }

        .user-profile .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 5px 10px;
            border-radius: 12px;
            transition: all 0.3s;
            text-decoration: none;
            color: #333;
            background: #f8f9fa;
            border: 1px solid transparent;
        }

        .user-profile .dropdown-toggle:hover {
            background: #e9ecef;
            border-color: #dee2e6;
        }

        .user-profile .dropdown-toggle::after {
            display: none;
        }

        /* Avatar */
        .avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
            box-shadow: 0 4px 10px rgba(102, 126, 234, 0.3);
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
        }

        /* User Info Text */
        .user-info-text {
            line-height: 1.4;
        }

        .user-info-text .name {
            font-weight: 600;
            color: #333;
            font-size: 0.95rem;
        }

        .user-info-text .role {
            font-size: 0.8rem;
            color: #6c757d;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .user-info-text .role i {
            font-size: 0.7rem;
            color: #667eea;
        }

        .user-info-text .role .badge-role {
            background: #e9ecef;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 500;
        }

        .badge-role.admin {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .badge-role.manager {
            background: #28a745;
            color: white;
        }

        .badge-role.user {
            background: #17a2b8;
            color: white;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            padding: 10px 0;
            min-width: 250px;
            margin-top: 10px !important;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .dropdown-header {
            padding: 10px 20px;
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 5px;
        }

        .dropdown-header h6 {
            margin: 0;
            font-weight: 600;
            color: #333;
        }

        .dropdown-header p {
            margin: 5px 0 0;
            font-size: 0.8rem;
            color: #6c757d;
        }

        .dropdown-item {
            padding: 10px 20px;
            color: #495057;
            font-size: 0.95rem;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .dropdown-item i {
            width: 20px;
            color: #667eea;
            font-size: 1rem;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .dropdown-item:hover i {
            color: white;
        }

        .dropdown-divider {
            margin: 8px 0;
            border-color: #dee2e6;
        }

        /* Quick Actions Menu (dari notification) */
        .notification-menu {
            min-width: 350px;
            padding: 0;
        }

        .notification-header {
            padding: 15px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0;
        }

        .notification-header h6 {
            margin: 0;
            font-weight: 600;
        }

        .notification-item {
            padding: 15px 20px;
            border-bottom: 1px solid #dee2e6;
            transition: all 0.3s;
        }

        .notification-item:hover {
            background: #f8f9fa;
        }

        .notification-item.unread {
            background: #e8f4ff;
        }

        .notification-item .time {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 5px;
        }

        .notification-footer {
            padding: 12px 20px;
            text-align: center;
            background: #f8f9fa;
            border-radius: 0 0 15px 15px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -280px;
            }
            .sidebar.active {
                margin-left: 0;
            }
            .main-content {
                margin-left: 0;
            }
            .main-content.active {
                margin-left: 280px;
            }
            .user-info-text {
                display: none;
            }
            .notification-menu {
                min-width: 300px;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h3><i class="fas fa-clock me-2"></i>Absensi System</h3>
                <p>Employee Attendance Management</p>
            </div>
            
            <div class="nav-menu">
                <!-- Dashboard -->
                <div class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-pie"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                
                <!-- Employees -->
                <div class="nav-item">
                    <a href="{{ route('employees.index') }}" class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Employees</span>
                    </a>
                </div>
                
                <!-- Attendance -->
                <div class="nav-item">
                    <a href="{{ route('attendances.index') }}" class="nav-link {{ request()->routeIs('attendances.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-check"></i>
                        <span>Attendance</span>
                    </a>
                </div>
                
                <!-- Reports -->
                <div class="nav-item">
                    <a href="{{ route('reports.index') }}" class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reports</span>
                    </a>
                </div>
                
                <!-- Help -->
                <div class="nav-item">
                    <a href="{{ route('help.index') }}" class="nav-link {{ request()->routeIs('help.*') ? 'active' : '' }}">
                        <i class="fas fa-question-circle"></i>
                        <span>Help</span>
                    </a>
                </div>
                
                <hr style="border-color: rgba(255,255,255,0.1); margin: 20px 15px;">
                
                <!-- Settings (hanya untuk admin) -->
                @if(auth()->user() && auth()->user()->isAdmin())
                <div class="nav-item">
                    <a href="{{ route('settings.index') }}" class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- ============================================ -->
            <!-- TOP NAVBAR - LENGKAP DENGAN USER PROFILE -->
            <!-- ============================================ -->
            <div class="top-navbar">
                <!-- Page Title -->
                <div class="page-title">
                    <h4>@yield('title', 'Dashboard')</h4>
                    <span>
                        <i class="fas fa-calendar-alt"></i>
                        {{ now()->format('l, d F Y') }}
                        <i class="fas fa-clock ms-2"></i>
                        <span id="liveClock"></span>
                    </span>
                </div>
                
                <!-- User Info Section -->
                <div class="user-info">
                    <!-- Notification Bell -->
                    <div class="notification dropdown">
                        <a href="#" class="text-dark" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end notification-menu">
                            <div class="notification-header">
                                <h6 class="mb-0">Notifications</h6>
                            </div>
                            
                            <div class="notification-item unread">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                                        <i class="fas fa-user-plus text-primary"></i>
                                    </div>
                                    <div>
                                        <p class="mb-1"><strong>John Doe</strong> checked in late</p>
                                        <small class="time">5 minutes ago</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="notification-item">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-2">
                                        <i class="fas fa-check-circle text-success"></i>
                                    </div>
                                    <div>
                                        <p class="mb-1"><strong>Jane Smith</strong> checked out</p>
                                        <small class="time">1 hour ago</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="notification-item">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                                        <i class="fas fa-exclamation-triangle text-warning"></i>
                                    </div>
                                    <div>
                                        <p class="mb-1">5 employees haven't checked in</p>
                                        <small class="time">2 hours ago</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="notification-footer">
                                <a href="#" class="text-primary text-decoration-none">View All Notifications</a>
                            </div>
                        </div>
                    </div>

                    <!-- User Profile Dropdown -->
                    <div class="user-profile dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- Avatar -->
                            <div class="avatar">
                                @if(auth()->user() && auth()->user()->photo)
                                    <img src="{{ asset(auth()->user()->photo) }}" alt="{{ auth()->user()->name }}">
                                @else
                                    <span>{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                                @endif
                            </div>
                            
                            <!-- User Info -->
                            <div class="user-info-text">
                                <div class="name">{{ auth()->user()->name ?? 'User' }}</div>
                                <div class="role">
                                    <i class="fas fa-circle" style="color: {{ auth()->user() && auth()->user()->isAdmin() ? '#667eea' : (auth()->user() && auth()->user()->isManager() ? '#28a745' : '#17a2b8') }}; font-size: 8px;"></i>
                                    <span class="badge-role {{ auth()->user() ? auth()->user()->role : 'user' }}">
                                        {{ auth()->user() ? ucfirst(auth()->user()->role) : 'User' }}
                                    </span>
                                </div>
                            </div>
                            
                            <i class="fas fa-chevron-down ms-2" style="font-size: 12px; color: #6c757d;"></i>
                        </a>

                        <!-- Dropdown Menu -->
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-header">
                                <h6>{{ auth()->user()->name ?? 'User' }}</h6>
                                <p>{{ auth()->user()->email ?? 'email@example.com' }}</p>
                            </li>
                            
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-clock"></i>
                                    Attendance History
                                </a>
                            </li>
                            
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-calendar-alt"></i>
                                    My Schedule
                                </a>
                            </li>
                            
                            <li><hr class="dropdown-divider"></li>
                            
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cog"></i>
                                    Account Settings
                                </a>
                            </li>
                            
                            <li>
                                <a class="dropdown-item" href="{{ route('help.index') }}">
                                    <i class="fas fa-question-circle"></i>
                                    Help Center
                                </a>
                            </li>
                            
                            <li><hr class="dropdown-divider"></li>
                            
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show fade-in" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show fade-in" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show fade-in" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Content Section -->
            <div class="fade-in">
                @yield('content')
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Live Clock
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('liveClock').textContent = hours + ':' + minutes + ':' + seconds;
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Untuk mobile: toggle sidebar
        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth <= 768) {
                const sidebar = document.querySelector('.sidebar');
                const mainContent = document.querySelector('.main-content');
                
                const toggleBtn = document.createElement('button');
                toggleBtn.className = 'btn btn-sm btn-outline-primary me-2 d-md-none';
                toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
                toggleBtn.onclick = function() {
                    sidebar.classList.toggle('active');
                    mainContent.classList.toggle('active');
                };
                document.querySelector('.page-title').prepend(toggleBtn);
            }
        });

        // Auto hide alerts after 5 seconds
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
    
    @stack('scripts')
</body>
</html>