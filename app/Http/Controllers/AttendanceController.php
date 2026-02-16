<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with('employee');
        
        // Filter by date
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        } else {
            $query->whereDate('date', Carbon::today());
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $attendances = $query->latest()->paginate(15);
        $employees = Employee::where('status', 'active')->get();
        
        return view('attendances.index', compact('attendances', 'employees'));
    }

    public function checkIn(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'photo' => 'nullable|image|max:2048'
        ]);

        $employee = Employee::findOrFail($request->employee_id);
        
        // Cek apakah sudah check-in hari ini
        $existingAttendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', Carbon::today())
            ->first();
            
        if ($existingAttendance) {
            return back()->with('error', 'Employee already checked in today.');
        }

        $data = [
            'employee_id' => $employee->id,
            'date' => Carbon::today(),
            'check_in' => Carbon::now(),
            'status' => $this->determineStatus(Carbon::now())
        ];

        // Handle photo
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = 'checkin_' . time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/attendances'), $filename);
            $data['photo_in'] = 'uploads/attendances/' . $filename;
        }

        Attendance::create($data);

        return back()->with('success', 'Check-in successful.');
    }

    public function checkOut(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'photo' => 'nullable|image|max:2048'
        ]);

        $attendance = Attendance::where('employee_id', $request->employee_id)
            ->whereDate('date', Carbon::today())
            ->first();

        if (!$attendance) {
            return back()->with('error', 'No check-in record found for today.');
        }

        if ($attendance->check_out) {
            return back()->with('error', 'Already checked out today.');
        }

        $attendance->check_out = Carbon::now();

        // Handle photo
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = 'checkout_' . time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/attendances'), $filename);
            $attendance->photo_out = 'uploads/attendances/' . $filename;
        }

        $attendance->save();

        return back()->with('success', 'Check-out successful.');
    }

    private function determineStatus($checkInTime)
    {
        $officeStart = Carbon::createFromTime(8, 0, 0); // 08:00 AM
        
        if ($checkInTime->gt($officeStart)) {
            return 'late';
        }
        
        return 'present';
    }
}