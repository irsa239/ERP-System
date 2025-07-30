<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
   protected $fillable = ['title', 'type', 'event_date', 'employee_id'];

}
