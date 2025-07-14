<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    // Optional: Specify table name if it’s not "attendances"
    // protected $table = 'attendances';

    // Allow mass assignment for these fields
    protected $fillable = [
        'employee_id',
        'date',
        'status', // present, absent, leave, etc.
    ];

    // Define relationship to Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
