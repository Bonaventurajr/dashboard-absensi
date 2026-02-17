<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $reportTitle }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }
        .header h1 {
            color: #667eea;
            margin: 0;
            font-size: 24px;
        }
        .header h3 {
            color: #764ba2;
            margin: 5px 0;
            font-size: 18px;
        }
        .header p {
            color: #666;
            margin: 5px 0;
            font-size: 12px;
        }
        .info-section {
            margin-bottom: 20px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        .info-section table {
            width: 100%;
        }
        .info-section td {
            padding: 5px;
            font-size: 12px;
        }
        .info-section .label {
            font-weight: bold;
            width: 150px;
            color: #555;
        }
        .stats-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .stat-box {
            flex: 1;
            text-align: center;
            padding: 10px;
            margin: 0 5px;
            border-radius: 5px;
            color: white;
        }
        .stat-box.total { background: #667eea; }
        .stat-box.present { background: #28a745; }
        .stat-box.late { background: #ffc107; color: #333; }
        .stat-box.absent { background: #dc3545; }
        .stat-box.leave { background: #17a2b8; }
        .stat-box .number {
            font-size: 24px;
            font-weight: bold;
        }
        .stat-box .label {
            font-size: 12px;
            text-transform: uppercase;
        }
        table.attendance-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table.attendance-table th {
            background: #667eea;
            color: white;
            padding: 10px;
            font-size: 11px;
            text-align: left;
        }
        table.attendance-table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        table.attendance-table tr:nth-child(even) {
            background: #f8f9fa;
        }
        .status-badge {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .status-present { background: #28a745; color: white; }
        .status-late { background: #ffc107; color: #333; }
        .status-absent { background: #dc3545; color: white; }
        .status-leave { background: #17a2b8; color: white; }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #666;
            padding: 10px 0;
            border-top: 1px solid #ddd;
        }
        .page-break {
            page-break-after: always;
        }
        .summary-section {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $companyName }}</h1>
        <h3>{{ $reportTitle }}</h3>
        <p>Generated on: {{ $generatedDate }}</p>
    </div>

    <div class="info-section">
        <table>
            <tr>
                <td class="label">Periode:</td>
                <td>{{ Carbon\Carbon::parse($startDate)->format('d F Y') }} - {{ Carbon\Carbon::parse($endDate)->format('d F Y') }}</td>
            </tr>
            @if($department)
            <tr>
                <td class="label">Department:</td>
                <td>{{ $department }}</td>
            </tr>
            @endif
            @if($status)
            <tr>
                <td class="label">Status Filter:</td>
                <td>{{ ucfirst($status) }}</td>
            </tr>
            @endif
            <tr>
                <td class="label">Total Records:</td>
                <td>{{ $statistics['total_attendances'] }} attendance records</td>
            </tr>
        </table>
    </div>

    <div class="stats-container">
        <div class="stat-box total">
            <div class="number">{{ $statistics['total_days'] }}</div>
            <div class="label">Total Days</div>
        </div>
        <div class="stat-box present">
            <div class="number">{{ $statistics['present'] }}</div>
            <div class="label">Present</div>
        </div>
        <div class="stat-box late">
            <div class="number">{{ $statistics['late'] }}</div>
            <div class="label">Late</div>
        </div>
        <div class="stat-box absent">
            <div class="number">{{ $statistics['absent'] }}</div>
            <div class="label">Absent</div>
        </div>
        <div class="stat-box leave">
            <div class="number">{{ $statistics['leave'] }}</div>
            <div class="label">Leave</div>
        </div>
    </div>

    <table class="attendance-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Employee</th>
                <th>Department</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Status</th>
                <th>Working Hours</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $attendance)
            <tr>
                <td>{{ Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}</td>
                <td>{{ $attendance->employee->name }}</td>
                <td>{{ $attendance->employee->department }}</td>
                <td>{{ $attendance->check_in ? Carbon\Carbon::parse($attendance->check_in)->format('H:i') : '-' }}</td>
                <td>{{ $attendance->check_out ? Carbon\Carbon::parse($attendance->check_out)->format('H:i') : '-' }}</td>
                <td>
                    @if($attendance->status == 'present')
                        <span class="status-badge status-present">Present</span>
                    @elseif($attendance->status == 'late')
                        <span class="status-badge status-late">Late</span>
                    @elseif($attendance->status == 'absent')
                        <span class="status-badge status-absent">Absent</span>
                    @else
                        <span class="status-badge status-leave">{{ ucfirst($attendance->status) }}</span>
                    @endif
                </td>
                <td>
                    @if($attendance->check_in && $attendance->check_out)
                        @php
                            $checkIn = Carbon\Carbon::parse($attendance->check_in);
                            $checkOut = Carbon\Carbon::parse($attendance->check_out);
                            $hours = $checkIn->diffInHours($checkOut);
                            $minutes = $checkIn->diffInMinutes($checkOut) % 60;
                        @endphp
                        {{ $hours }}h {{ $minutes }}m
                    @else
                        -
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 20px;">
                    No attendance records found for the selected period.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if(count($attendances) > 0)
    <div class="summary-section">
        <h4>Summary:</h4>
        <ul>
            <li>Attendance Rate: {{ round(($statistics['present'] + $statistics['late']) / $statistics['total_days'] * 100) }}%</li>
            <li>Average Daily Attendance: {{ round($statistics['total_attendances'] / $statistics['total_days'], 1) }} employees</li>
            <li>Late Percentage: {{ round($statistics['late'] / max($statistics['total_attendances'], 1) * 100) }}%</li>
        </ul>
    </div>
    @endif

    <div class="footer">
        <p>This report was generated automatically by Absensi System. For official use only.</p>
    </div>
</body>
</html>