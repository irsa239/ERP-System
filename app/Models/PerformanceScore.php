<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'score',        // Numeric score or percentage
        'month',
        'year',
        'remarks',
        'rating',       // ✅ Add this line
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
