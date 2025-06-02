<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $fillable = ['movie_id', 'image_url', 'alt_text'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}

