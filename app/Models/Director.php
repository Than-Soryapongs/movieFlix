<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    protected $fillable = ['name', 'dob', 'bio'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_director');
    }
}

