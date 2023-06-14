<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrudEvents extends Model
{
    protected $fillable = [
        'event_name', 
        'event_start', 
        'event_end'
    ];  
}
