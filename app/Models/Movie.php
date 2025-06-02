<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title', 'description', 'release_date', 'duration', 'rating'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'movie_actor')->withPivot('role');
    }

    public function directors()
    {
        return $this->belongsToMany(Director::class, 'movie_director');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function posters()
    {
        return $this->hasMany(Poster::class);
    }

    public function trailers()
    {
        return $this->hasMany(Trailer::class);
    }
}

