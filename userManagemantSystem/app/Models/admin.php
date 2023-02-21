<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class admin extends Authenticatable
{
    use HasFactory,HasApiTokens;

    protected $guard = "admin";

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}

