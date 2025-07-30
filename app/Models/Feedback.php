<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks'; // ✅ table name

    protected $fillable = [
        'employee_id',
        'given_by',
        'comments',     // ✅ fixed
        'rating',
        'month',        // ✅ fixed
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
