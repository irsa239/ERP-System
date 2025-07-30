<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cnic',
        'designation',
        'joining_date',
        'salary',
    ];

    // Relationships

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function performanceScores()
    {
        return $this->hasMany(PerformanceScore::class);
    }

    public function warnings()
    {
        return $this->hasMany(Warning::class);
    }

    public function selfEvaluations()
    {
        return $this->hasMany(SelfEvaluation::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}
