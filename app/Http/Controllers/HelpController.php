<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('help.index');
    }

    public function gettingStarted()
    {
        return view('help.getting-started');
    }

    public function employeeGuide()
    {
        return view('help.employee-guide');
    }

    public function attendanceGuide()
    {
        return view('help.attendance-guide');
    }

    public function reportsGuide()
    {
        return view('help.reports-guide');
    }

    public function faq()
    {
        $faqs = [
            [
                'question' => 'Bagaimana cara menambahkan karyawan baru?',
                'answer' => 'Masuk ke menu Employees, klik tombol "Add New Employee", isi data yang diperlukan dan simpan.'
            ],
            [
                'question' => 'Bagaimana cara merekam absensi?',
                'answer' => 'Anda dapat merekam absensi dengan mengklik tombol "Check In" atau "Check Out" di dashboard atau halaman attendance.'
            ],
            [
                'question' => 'Apa arti status absensi yang berbeda?',
                'answer' => 'Present: Check in tepat waktu, Late: Check in setelah jam 08:00, Absent: Tidak ada absensi, Leave: Cuti/ijin.'
            ],
        ];

        return view('help.faq', compact('faqs'));
    }

    public function contact()
    {
        return view('help.contact');
    }

    /**
     * Submit support ticket
     */
    public function submitTicket(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Di sini Anda bisa:
        // 1. Simpan ke database
        // 2. Kirim email
        // 3. Simpan ke file log
        
        // Untuk sementara, simpan ke session
        session(['ticket_submitted' => true]);

        // Redirect dengan pesan sukses
        return redirect()->route('help.contact')->with('success', 'Tiket support telah dikirim. Kami akan segera merespon.');
    }

    public function systemInfo()
    {
        $info = [
            'laravel_version' => app()->version(),
            'php_version' => phpversion(),
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
            'database_connection' => config('database.default'),
            'environment' => app()->environment(),
            'debug_mode' => config('app.debug') ? 'Enabled' : 'Disabled',
            'timezone' => config('app.timezone'),
            'date' => now()->format('Y-m-d H:i:s')
        ];

        return view('help.system-info', compact('info'));
    }
}