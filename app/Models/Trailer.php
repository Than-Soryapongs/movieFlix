<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trailer extends Model
{
    protected $fillable = ['movie_id', 'youtube_url', 'title'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}

