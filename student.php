<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class student extends Authenticatable
{
    protected $table = "student";
    use HasFactory;
    protected $fillable = [
        'name', 'email','phone', 'password',
    ];

    protected $hidden = ['password'];
}
