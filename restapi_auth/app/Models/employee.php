<?php

namespace App\Models;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class employee extends Model
{
    use HasFactory, Uuids, HasApiTokens, Notifiable;

    protected $fillable = ['dob', 'first_name', 'last_name', 'email', 'password', 'number'];

    protected $guard = 'employee';
}
 

