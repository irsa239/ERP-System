<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class BiometricAttendance extends Model
{
     use HasFactory;

    protected $fillable = ['employee_id', 'date', 'time_in', 'time_out'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
