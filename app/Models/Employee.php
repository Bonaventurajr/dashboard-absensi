<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'name', 'email', 'position', 
        'department', 'phone', 'address', 'photo', 'status'
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function getTodayAttendance()
    {
        return $this->attendances()
            ->whereDate('date', today())
            ->first();
    }
}