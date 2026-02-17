<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Display reports index page
     */
    public function index(Request $request)
    {
        // Default date range (current month)
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));
        $department = $request->get('department');
        $status = $request->get('status');
        $employeeId = $request->get('employee_id');

        // Build query
        $query = Attendance::with('employee')
            ->whereBetween('date', [$startDate, $endDate]);

        if ($department) {
            $query->whereHas('employee', function($q) use ($department) {
                $q->where('department', $department);
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($employeeId) {
            $query->where('employee_id', $employeeId);
        }

        $attendances = $query->orderBy('date', 'desc')->get();

        // Calculate statistics
        $statistics = [
            'total_days' => Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)) + 1,
            'total_attendances' => $attendances->count(),
            'present' => $attendances->where('status', 'present')->count(),
            'late' => $attendances->where('status', 'late')->count(),
            'absent' => $attendances->where('status', 'absent')->count(),
            'leave' => $attendances->where('status', 'leave')->count(),
        ];

        // Department wise statistics
        $departmentStats = Employee::select('department', DB::raw('count(*) as total'))
            ->groupBy('department')
            ->get();

        // Monthly trend data
        $monthlyTrend = Attendance::select(
                DB::raw('MONTH(date) as month'),
                DB::raw('YEAR(date) as year'),
                DB::raw('COUNT(*) as total'),
                DB::raw("SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) as present"),
                DB::raw("SUM(CASE WHEN status = 'late' THEN 1 ELSE 0 END) as late"),
                DB::raw("SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) as absent")
            )
            ->whereYear('date', Carbon::now()->year)
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Top employees by attendance
        $topEmployees = Attendance::select(
                'employee_id',
                DB::raw('COUNT(*) as total_attendances'),
                DB::raw("SUM(CASE WHEN status IN ('present', 'late') THEN 1 ELSE 0 END) as present_count")
            )
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('employee_id')
            ->with('employee')
            ->orderBy('present_count', 'desc')
            ->limit(5)
            ->get();

        // Data for charts
        $departments = Employee::select('department')->distinct()->pluck('department');
        $employees = Employee::all();

        return view('reports.index', compact(
            'attendances',
            'statistics',
            'startDate',
            'endDate',
            'department',
            'status',
            'employeeId',
            'departmentStats',
            'monthlyTrend',
            'topEmployees',
            'departments',
            'employees'
        ));
    }

    /**
     * Export report to PDF
     */
    public function exportPdf(Request $request)
    {
        // Get filter parameters
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));
        $department = $request->get('department');
        $status = $request->get('status');
        $employeeId = $request->get('employee_id');

        // Build query
        $query = Attendance::with('employee')
            ->whereBetween('date', [$startDate, $endDate]);

        if ($department) {
            $query->whereHas('employee', function($q) use ($department) {
                $q->where('department', $department);
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($employeeId) {
            $query->where('employee_id', $employeeId);
        }

        $attendances = $query->orderBy('date', 'desc')->get();

        // Calculate statistics
        $statistics = [
            'total_days' => Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)) + 1,
            'total_attendances' => $attendances->count(),
            'present' => $attendances->where('status', 'present')->count(),
            'late' => $attendances->where('status', 'late')->count(),
            'absent' => $attendances->where('status', 'absent')->count(),
            'leave' => $attendances->where('status', 'leave')->count(),
        ];

        // Get company info
        $companyName = session('company_name', 'PT. Bonaventura Harapan Sejahtera');
        $reportTitle = 'Attendance Report';
        $generatedDate = Carbon::now()->format('d F Y H:i:s');

        // Generate PDF
        $pdf = Pdf::loadView('reports.pdf', compact(
            'attendances', 
            'statistics', 
            'startDate', 
            'endDate',
            'companyName',
            'reportTitle',
            'generatedDate',
            'department',
            'status'
        ));

        // Set paper size and orientation
        $pdf->setPaper('A4', 'landscape');

        // Download PDF
        $filename = 'attendance-report-'.$startDate.'-to-'.$endDate.'.pdf';
        return $pdf->download($filename);
    }

    /**
     * Export report to Excel (placeholder)
     */
    public function exportExcel(Request $request)
    {
        // Untuk sementara redirect dengan pesan
        return back()->with('info', 'Excel export feature will be available soon. Please install maatwebsite/excel package.');
    }

    /**
     * Get employee individual report
     */
    public function employeeReport(Request $request, $employeeId = null)
    {
        $employee = Employee::findOrFail($employeeId ?? $request->employee_id);
        
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $attendances = Attendance::where('employee_id', $employee->id)
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'desc')
            ->get();

        $statistics = [
            'total' => $attendances->count(),
            'present' => $attendances->where('status', 'present')->count(),
            'late' => $attendances->where('status', 'late')->count(),
            'absent' => $attendances->where('status', 'absent')->count(),
            'leave' => $attendances->where('status', 'leave')->count(),
        ];

        return view('reports.employee', compact('employee', 'attendances', 'statistics', 'startDate', 'endDate'));
    }

    /**
     * Get daily report
     */
    public function dailyReport(Request $request)
    {
        $date = $request->get('date', Carbon::today()->format('Y-m-d'));
        
        $attendances = Attendance::with('employee')
            ->whereDate('date', $date)
            ->get();

        $totalEmployees = Employee::where('status', 'active')->count();
        $present = $attendances->whereIn('status', ['present', 'late'])->count();
        $absent = $totalEmployees - $present;

        return view('reports.daily', compact('attendances', 'date', 'totalEmployees', 'present', 'absent'));
    }

    /**
     * Get monthly summary
     */
    public function monthlySummary(Request $request)
    {
        $month = $request->get('month', Carbon::now()->month);
        $year = $request->get('year', Carbon::now()->year);

        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();

        $summary = Employee::with(['attendances' => function($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate]);
            }])
            ->where('status', 'active')
            ->get()
            ->map(function($employee) use ($startDate, $endDate) {
                $totalDays = $startDate->diffInDays($endDate) + 1;
                $attendances = $employee->attendances;
                
                return [
                    'employee' => $employee,
                    'total_days' => $totalDays,
                    'present' => $attendances->whereIn('status', ['present', 'late'])->count(),
                    'late' => $attendances->where('status', 'late')->count(),
                    'absent' => $attendances->where('status', 'absent')->count(),
                    'leave' => $attendances->where('status', 'leave')->count(),
                    'attendance_rate' => $totalDays > 0 ? round(($attendances->whereIn('status', ['present', 'late'])->count() / $totalDays) * 100) : 0
                ];
            });

        return view('reports.monthly', compact('summary', 'month', 'year'));
    }
}