<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'genre', 'release_year', 'poster'];

    public function user()
   {
      return $this->belongsTo(User::class, 'user_id'); 
  } 


    public function comment(){
    return $this->hasMany(Comment::class, 'movie_id');
    }

}
  