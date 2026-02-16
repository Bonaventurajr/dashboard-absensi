<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Attendance;
use Carbon\Carbon;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        // Create employees
        $employees = [
            [
                'employee_id' => 'EMP-001',
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'position' => 'Software Engineer',
                'department' => 'IT',
                'phone' => '081234567890',
                'address' => 'Jakarta',
                'status' => 'active'
            ],
            [
                'employee_id' => 'EMP-002',
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'position' => 'HR Manager',
                'department' => 'HR',
                'phone' => '081234567891',
                'address' => 'Bandung',
                'status' => 'active'
            ],
            [
                'employee_id' => 'EMP-003',
                'name' => 'Bob Johnson',
                'email' => 'bob.johnson@example.com',
                'position' => 'Financial Analyst',
                'department' => 'Finance',
                'phone' => '081234567892',
                'address' => 'Surabaya',
                'status' => 'active'
            ],
        ];

        foreach ($employees as $employeeData) {
            $employee = Employee::create($employeeData);
            
            // Create attendance for last 7 days
            for ($i = 0; $i < 7; $i++) {
                $date = Carbon::today()->subDays($i);
                
                // Random check-in time (between 07:30 - 09:00)
                $checkIn = Carbon::parse($date->format('Y-m-d') . ' ' . rand(7, 9) . ':' . rand(0, 59) . ':00');
                
                // Random check-out time (between 16:00 - 18:00)
                $checkOut = Carbon::parse($date->format('Y-m-d') . ' ' . rand(16, 18) . ':' . rand(0, 59) . ':00');
                
                // Determine status
                $officeStart = Carbon::parse($date->format('Y-m-d') . ' 08:00:00');
                $status = $checkIn->gt($officeStart) ? 'late' : 'present';
                
                Attendance::create([
                    'employee_id' => $employee->id,
                    'date' => $date,
                    'check_in' => $checkIn,
                    'check_out' => $checkOut,
                    'status' => $status,
                    'notes' => null
                ]);
            }
        }
    }
}