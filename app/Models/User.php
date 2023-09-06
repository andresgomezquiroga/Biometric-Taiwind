<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name' ,
        'edad' ,
        'email',
        'type_document' ,
        'number_document' ,
        'image' ,
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function fichas()
    {
        return $this->belongsToMany(Ficha::class, 'members_fichas', 'user_id', 'ficha_id');
    }

    public function excuses()
    {
        return $this->hasMany(Excuse::class, 'user_id');
    }

    public function ficha()
    {
        return $this->belongsTo(Ficha::class, 'id_ficha', 'id');
    }

}
