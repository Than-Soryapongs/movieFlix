<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MovieController extends Controller
{
    // Show all movies with posters and titles (with optional search)
    public function index(Request $request)
    {
        $query = $request->input('q');
        $actorId = $request->input('actor');
        $directorId = $request->input('director');
        $genreId = $request->input('genre');

        $moviesQuery = Movie::with('posters', 'actors', 'directors', 'genres');

        // Filter by movie title (search)
        if ($query) {
            $moviesQuery->where('title', 'LIKE', "%{$query}%");
        }

        // Filter by actor
        if ($actorId) {
            $moviesQuery->whereHas('actors', function($q) use ($actorId) {
                $q->where('actors.id', $actorId);
            });
        }

        // Filter by director
        if ($directorId) {
            $moviesQuery->whereHas('directors', function($q) use ($directorId) {
                $q->where('directors.id', $directorId);
            });
        }

        // Filter by genre
        if ($genreId) {
            $moviesQuery->whereHas('genres', function($q) use ($genreId) {
                $q->where('genres.id', $genreId);
            });
        }

        // Paginate results and keep query parameters in pagination links
        $movies = $moviesQuery->paginate(12)->withQueryString();

        // Load all actors, directors, genres for filter dropdowns
        $actors = Actor::orderBy('name')->get();
        $directors = Director::orderBy('name')->get();  
        $genres = Genre::orderBy('name')->get();

        return view('welcome', compact('movies', 'actors', 'directors', 'genres'));
    }

    // Show single movie details page with all info
    public function show(Movie $movie)
    {
        $movie->load(['posters', 'trailers', 'genres', 'actors', 'directors', 'reviews']);

        return view('movies.show', compact('movie'));
    }
}
