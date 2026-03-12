<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'userID';

    protected $fillable = [
        'username',
        'password',
        'email',
        'namaLengkap',
        'alamat',
        'role',
    ];

    protected $hidden = [
        'password',
    ];
}