<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_attendance',
        'code_attendance',
        'time_attendance',
        'description',
        'aprendiz',
    ];

    protected $primaryKey = 'id_attendance';

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    
}
