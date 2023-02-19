<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin extends Authenticatable
{
    use HasFactory;

    protected $guard = "admin";

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'name',
        'email',
        'password',
   
    ];
}

