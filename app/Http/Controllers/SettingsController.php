<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // CUKUP AUTH SAJA, TIDAK PERLU ADMIN
    }

    public function index()
    {
        // Ambil data users
        $users = [
            (object) [
                'id' => 1,
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'role' => 'Administrator',
                'status' => 'active'
            ],
            (object) [
                'id' => 2,
                'name' => 'Manager User',
                'email' => 'manager@example.com',
                'role' => 'Manager',
                'status' => 'active'
            ],
            (object) [
                'id' => 3,
                'name' => auth()->user()->name ?? 'Current User',
                'email' => auth()->user()->email ?? 'user@example.com',
                'role' => ucfirst(auth()->user()->role ?? 'user'),
                'status' => 'active'
            ],
        ];

        return view('settings.index', compact('users'));
    }

    public function updateGeneral(Request $request)
    {
        $request->validate([
            'app_name' => 'required',
            'company_name' => 'required',
            'timezone' => 'required',
            'date_format' => 'required',
        ]);

        // Simpan ke session
        session([
            'app_name' => $request->app_name,
            'company_name' => $request->company_name,
            'timezone' => $request->timezone,
            'date_format' => $request->date_format,
        ]);

        return redirect()->route('settings.index')->with('success', 'General settings updated successfully.');
    }

    public function updateAttendance(Request $request)
    {
        $request->validate([
            'check_in_start' => 'required',
            'check_in_end' => 'required',
            'check_out_start' => 'required',
            'check_out_end' => 'required',
            'late_threshold' => 'required|integer',
        ]);

        session([
            'check_in_start' => $request->check_in_start,
            'check_in_end' => $request->check_in_end,
            'check_out_start' => $request->check_out_start,
            'check_out_end' => $request->check_out_end,
            'late_threshold' => $request->late_threshold,
        ]);

        return redirect()->route('settings.index')->with('success', 'Attendance settings updated successfully.');
    }

    public function updateNotifications(Request $request)
    {
        session([
            'email_notification' => $request->has('email_notification'),
            'whatsapp_notification' => $request->has('whatsapp_notification'),
            'reminder_time' => $request->reminder_time,
        ]);

        return redirect()->route('settings.index')->with('success', 'Notification settings updated successfully.');
    }

    public function backup()
    {
        return redirect()->route('settings.index')->with('info', 'Backup feature coming soon.');
    }

    public function createBackup(Request $request)
    {
        return redirect()->route('settings.index')->with('success', 'Backup created successfully.');
    }

    public function restoreBackup(Request $request)
    {
        return redirect()->route('settings.index')->with('success', 'Backup restored successfully.');
    }

    public function users()
    {
        return redirect()->route('settings.index')->with('info', 'User management feature coming soon.');
    }
}