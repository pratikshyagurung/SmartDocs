<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Editor extends Authenticatable
{
    use Notifiable;
    protected $table = 'editors';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'password',
        'status',
        'profile_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'password' => 'hashed',
    ];
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
