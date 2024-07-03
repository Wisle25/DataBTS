<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;

class Pengguna extends Authenticable
{
    use HasFactory;

    protected $table = "pengguna";

    // Mass assignable attributes
    protected $fillable = [
        'nama',
        'username',
        'password',
        'email',
        'peran',
        'status',
    ];

    // Hidden attributes
    protected $hidden = [
        'password',
    ];
}
