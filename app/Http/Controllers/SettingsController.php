<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

class SettingsController extends Controller
{
    /**
     * Display general settings
     */
    public function index()
    {
        // Ambil data users dari database atau buat data dummy
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
                'name' => 'Supervisor User',
                'email' => 'supervisor@example.com',
                'role' => 'Supervisor',
                'status' => 'active'
            ],
        ];

        return view('settings.index', compact('users'));
    }

    /**
     * Update general settings
     */
    public function updateGeneral(Request $request)
    {
        $request->validate([
            'app_name' => 'required',
            'company_name' => 'required',
            'timezone' => 'required',
            'date_format' => 'required',
        ]);

        // Simpan ke file .env atau database
        // Untuk sementara, simpan ke session
        session([
            'app_name' => $request->app_name,
            'company_name' => $request->company_name,
            'timezone' => $request->timezone,
            'date_format' => $request->date_format,
        ]);

        return redirect()->route('settings.index')->with('success', 'General settings updated successfully.');
    }

    /**
     * Display attendance settings
     */
    public function attendance()
    {
        $users = $this->getDummyUsers();
        return view('settings.attendance', compact('users'));
    }

    /**
     * Update attendance settings
     */
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

        return redirect()->route('settings.index', ['tab' => 'attendance'])->with('success', 'Attendance settings updated successfully.');
    }

    /**
     * Display notification settings
     */
    public function notifications()
    {
        $users = $this->getDummyUsers();
        return view('settings.notifications', compact('users'));
    }

    /**
     * Update notification settings
     */
    public function updateNotifications(Request $request)
    {
        session([
            'email_notification' => $request->has('email_notification'),
            'whatsapp_notification' => $request->has('whatsapp_notification'),
            'reminder_time' => $request->reminder_time,
        ]);

        return redirect()->route('settings.index', ['tab' => 'notifications'])->with('success', 'Notification settings updated successfully.');
    }

    /**
     * Display backup settings
     */
    public function backup()
    {
        $users = $this->getDummyUsers();
        return view('settings.backup', compact('users'));
    }

    /**
     * Create backup
     */
    public function createBackup(Request $request)
    {
        // Logika backup database
        return redirect()->route('settings.index', ['tab' => 'backup'])->with('success', 'Backup created successfully.');
    }

    /**
     * Restore backup
     */
    public function restoreBackup(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file'
        ]);

        // Logika restore backup
        return redirect()->route('settings.index', ['tab' => 'backup'])->with('success', 'Backup restored successfully.');
    }

    /**
     * Display user management
     */
    public function users()
    {
        $users = $this->getDummyUsers();
        return view('settings.users', compact('users'));
    }

    /**
     * Get dummy users data
     */
    private function getDummyUsers()
    {
        return [
            (object) [
                'id' => 1,
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'role' => 'Administrator',
                'status' => 'active',
                'last_login' => '2024-02-17 08:30:00'
            ],
            (object) [
                'id' => 2,
                'name' => 'Manager User',
                'email' => 'manager@example.com',
                'role' => 'Manager',
                'status' => 'active',
                'last_login' => '2024-02-17 08:45:00'
            ],
            (object) [
                'id' => 3,
                'name' => 'Supervisor User',
                'email' => 'supervisor@example.com',
                'role' => 'Supervisor',
                'status' => 'active',
                'last_login' => '2024-02-17 08:15:00'
            ],
            (object) [
                'id' => 4,
                'name' => 'Staff User',
                'email' => 'staff@example.com',
                'role' => 'Staff',
                'status' => 'active',
                'last_login' => '2024-02-17 09:00:00'
            ],
            (object) [
                'id' => 5,
                'name' => 'Inactive User',
                'email' => 'inactive@example.com',
                'role' => 'Staff',
                'status' => 'inactive',
                'last_login' => '2024-02-10 10:30:00'
            ],
        ];
    }
}