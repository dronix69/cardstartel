<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor', 
        'alumno', 
        'color', 
        'start_at', 
        'end_at',
        
    ];
}
