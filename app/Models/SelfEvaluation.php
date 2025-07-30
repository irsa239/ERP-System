<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelfEvaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'strengths',
        'weaknesses',
        'goals',
        'submitted_on',
        'overall_rating',    // Optional
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
