<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = ['name', 'dob', 'bio'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_actor')->withPivot('role');
    }
}

