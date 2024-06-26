<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class timeTable extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_timeTable';

    protected $fillable = [
        'jornada',
        'time_start',
        'time_end',
        'date_start',
        'date_end',
        'ficha_id',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class, 'ficha_id');

    }
}
