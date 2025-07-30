<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'reason',
        'date_issued',
        'issued_by',     // Admin or HR name
        'status',        // e.g. First, Final, etc.
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
