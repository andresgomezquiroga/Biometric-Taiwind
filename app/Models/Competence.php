<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_competence';

    protected $fillable = [
        'code_competence',
        'name_competence',
        'description',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
