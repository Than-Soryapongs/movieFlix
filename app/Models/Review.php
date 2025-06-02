<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['movie_id', 'user_name', 'rating', 'comment'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
