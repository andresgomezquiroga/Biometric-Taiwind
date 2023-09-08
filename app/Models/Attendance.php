<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_attendance',
        'name_attendance',
        'time_attendance',
        'apprentices_assisted'
    ];

    protected $primaryKey = 'id_attendance';

    protected $hidden = [
        'created_at',
        'updated_at',
    ];



}
