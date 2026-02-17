<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        // Middleware sudah diatur di routes, tidak perlu di sini
    }

    public function index()
    {
        // Cek manual jika perlu
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

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
        ];

        return view('settings.index', compact('users'));
    }

    public function updateGeneral(Request $request)
    {
        // Validasi
        $request->validate([
            'app_name' => 'required',
            'company_name' => 'required',
            'timezone' => 'required',
        ]);

        // Simpan ke session
        session([
            'app_name' => $request->app_name,
            'company_name' => $request->company_name,
            'timezone' => $request->timezone,
        ]);

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully.');
    }

    // Method lainnya...
}