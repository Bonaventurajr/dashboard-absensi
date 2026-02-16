<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    /**
     * Display help main page
     */
    public function index()
    {
        return view('help.index');
    }

    /**
     * Display getting started guide
     */
    public function gettingStarted()
    {
        return view('help.getting-started');
    }

    /**
     * Display employee management guide
     */
    public function employeeGuide()
    {
        return view('help.employee-guide');
    }

    /**
     * Display attendance guide
     */
    public function attendanceGuide()
    {
        return view('help.attendance-guide');
    }

    /**
     * Display reports guide
     */
    public function reportsGuide()
    {
        return view('help.reports-guide');
    }

    /**
     * Display FAQ
     */
    public function faq()
    {
        $faqs = [
            [
                'question' => 'How do I add a new employee?',
                'answer' => 'Go to Employees menu, click "Add New Employee" button, fill in the required information and save.'
            ],
            [
                'question' => 'How do I record attendance?',
                'answer' => 'You can record attendance by clicking the "Check In" or "Check Out" buttons on the dashboard or attendance page.'
            ],
            [
                'question' => 'What do the different attendance statuses mean?',
                'answer' => 'Present: Checked in on time, Late: Checked in after 8:00 AM, Absent: No attendance record, Leave: Approved time off.'
            ],
            [
                'question' => 'Can I generate reports for specific dates?',
                'answer' => 'Yes, go to Reports page and select your desired date range, department, or employee to generate customized reports.'
            ],
            [
                'question' => 'How do I export attendance data?',
                'answer' => 'On the Reports page, after generating your report, click the "Export to PDF" or "Export to Excel" button.'
            ],
            [
                'question' => 'What if an employee forgets to check out?',
                'answer' => 'You can manually update the attendance record by editing it in the attendance list.'
            ],
            [
                'question' => 'How is "late" determined?',
                'answer' => 'The system considers check-ins after 8:00 AM as late. You can change this time in the settings.'
            ],
            [
                'question' => 'Can I track multiple departments?',
                'answer' => 'Yes, you can assign employees to different departments and filter reports by department.'
            ]
        ];

        return view('help.faq', compact('faqs'));
    }

    /**
     * Display contact support
     */
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
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        // Here you would typically send an email or save to database
        // For now, just redirect with success message

        return back()->with('success', 'Your support ticket has been submitted. We will get back to you soon.');
    }

    /**
     * Display system information
     */
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