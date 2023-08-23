<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excuse extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_excuse';

    protected $fillable = [
        'comment',
        'archive',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
