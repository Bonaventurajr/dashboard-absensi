<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::where('status', 'active')->count();
        
        // Statistik hari ini
        $today = Carbon::today();
        $todayAttendances = Attendance::whereDate('date', $today)->get();
        
        $presentToday = $todayAttendances->where('status', 'present')->count();
        $lateToday = $todayAttendances->where('status', 'late')->count();
        $absentToday = $totalEmployees - $todayAttendances->count();
        
        // Belum check out
        $notCheckedOut = $todayAttendances->whereNull('check_out')->count();
        
        // Data untuk chart (7 hari terakhir)
        $dates = [];
        $attendanceCounts = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dates[] = $date->format('d M');
            
            $count = Attendance::whereDate('date', $date)->count();
            $attendanceCounts[] = $count;
        }
        
        // Recent attendances
        $recentAttendances = Attendance::with('employee')
            ->latest()
            ->take(10)
            ->get();
        
        // Active employees untuk dropdown modal
        $activeEmployees = Employee::where('status', 'active')->get();
        
        return view('dashboard', compact(
            'totalEmployees',
            'presentToday',
            'lateToday',
            'absentToday',
            'notCheckedOut',
            'dates',
            'attendanceCounts',
            'recentAttendances',
            'activeEmployees' // Tambahkan ini
        ));
    }
}