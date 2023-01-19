<?php

namespace App\Models;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['dob', 'first_name', 'last_name', 'email', 'password', 'number'];
}
