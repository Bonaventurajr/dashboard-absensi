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

        .sidebar .nav-link span {
            flex: 1;
        }

        .sidebar .nav-link .badge {
            background: rgba(255,255,255,0.3);
            color: white;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 0.7rem;
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

        /* Navbar atas */
        .top-navbar {
            background: white;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-navbar .page-title h4 {
            margin: 0;
            font-weight: 600;
            color: #333;
        }

        .top-navbar .page-title span {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .top-navbar .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .top-navbar .user-info .notification {
            position: relative;
            cursor: pointer;
        }

        .top-navbar .user-info .notification i {
            font-size: 1.3rem;
            color: #6c757d;
        }

        .top-navbar .user-info .notification .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .top-navbar .user-info .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .top-navbar .user-info .user-profile .avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .top-navbar .user-info .user-profile .info {
            line-height: 1.3;
        }

        .top-navbar .user-info .user-profile .info .name {
            font-weight: 600;
            color: #333;
        }

        .top-navbar .user-info .user-profile .info .role {
            font-size: 0.8rem;
            color: #6c757d;
        }

        /* Cards */
        .stat-card {
            transition: all 0.3s;
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            overflow: hidden;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .stat-card .card-body {
            padding: 25px;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
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
        }

        /* Animasi */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Table styling */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            border-top: none;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #495057;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            vertical-align: middle;
            color: #6c757d;
        }

        .badge {
            padding: 8px 12px;
            font-weight: 500;
            border-radius: 30px;
        }

        /* Button styling */
        .btn {
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd6 0%, #6a4193 100%);
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
                <div class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-pie"></i>
                        <span>Dashboard</span>
                        @php
                            $todayCount = App\Models\Attendance::whereDate('date', today())->count();
                        @endphp
                        @if($todayCount > 0)
                            <span class="badge">{{ $todayCount }}</span>
                        @endif
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('employees.index') }}" class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Employees</span>
                        @php
                            $empCount = App\Models\Employee::count();
                        @endphp
                        @if($empCount > 0)
                            <span class="badge">{{ $empCount }}</span>
                        @endif
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('attendances.index') }}" class="nav-link {{ request()->routeIs('attendances.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-check"></i>
                        <span>Attendance</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('reports.index') }}" class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reports</span>
                    </a>
                </div>
                
                <hr style="border-color: rgba(255,255,255,0.1); margin: 20px 15px;">
                
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-question-circle"></i>
                        <span>Help</span>
                    </a>
                </div>
            </div>
            
            <div style="position: absolute; bottom: 20px; left: 20px; right: 20px;">
                <div class="text-white-50 small">
                    <i class="fas fa-chevron-up me-1"></i> v1.0.0
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navbar -->
            <div class="top-navbar">
                <div class="page-title">
                    <h4>@yield('title', 'Dashboard')</h4>
                    <span>{{ now()->format('l, d F Y') }}</span>
                </div>
                
                <div class="user-info">
                    <div class="notification">
                        <i class="fas fa-bell"></i>
                        <span class="badge">3</span>
                    </div>
                    
                    <div class="user-profile">
                        <div class="avatar">
                            <span>AD</span>
                        </div>
                        <div class="info d-none d-md-block">
                            <div class="name">Admin User</div>
                            <div class="role">Administrator</div>
                        </div>
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

            <!-- Content Section -->
            <div class="fade-in">
                @yield('content')
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Optional JavaScript for sidebar toggle on mobile -->
    <script>
        // Untuk mobile: toggle sidebar
        document.addEventListener('DOMContentLoaded', function() {
            // Cek jika layar mobile
            if (window.innerWidth <= 768) {
                const sidebar = document.querySelector('.sidebar');
                const mainContent = document.querySelector('.main-content');
                
                // Tambahkan tombol toggle di top navbar untuk mobile
                const pageTitle = document.querySelector('.page-title');
                const toggleBtn = document.createElement('button');
                toggleBtn.className = 'btn btn-sm btn-outline-primary me-2 d-md-none';
                toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
                toggleBtn.onclick = function() {
                    sidebar.classList.toggle('active');
                    mainContent.classList.toggle('active');
                };
                pageTitle.prepend(toggleBtn);
            }
        });

        // Untuk highlight menu berdasarkan scroll
        window.addEventListener('scroll', function() {
            // Implementasi jika diperlukan
        });
    </script>
    
    @stack('scripts')
</body>
</html>