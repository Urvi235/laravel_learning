<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment','user_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function user()
    {
       return $this->belongsTo(User::class, 'user_id'); 
   } 

   public function movies()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }

}
