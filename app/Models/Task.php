<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'title',
        'description',
        'status',         // Pending, Completed, In Progress
        'due_date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
