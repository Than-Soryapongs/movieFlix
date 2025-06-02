<?php

namespace App\Http\Controllers\Admin;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController
{
    public function index()
    {
        $movies = Movie::with('posters')->paginate(12);
        return view('admin.movies.index', compact('movies'));
    }

    public function create()
    {
        return view('admin.movies.create', [
            'genres' => Genre::all(),
            'actors' => Actor::all(),
            'directors' => Director::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'duration' => 'nullable|integer',
            'rating' => 'nullable|numeric|min:0|max:10',
            'genres' => 'array',
            'actors' => 'array',
            'directors' => 'array',
            'poster' => 'nullable|image|max:2048',
            'trailers' => 'array',
            'trailers.*.title' => 'nullable|string|max:255',
            'trailers.*.youtube_url' => 'nullable|url',
        ]);

        $movie = Movie::create($data);
        $movie->genres()->sync($request->input('genres', []));
        $movie->actors()->sync($request->input('actors', []));
        $movie->directors()->sync($request->input('directors', []));

        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('posters', 'public');
            $movie->posters()->create(['image_url' => $path]);
        }

        if ($request->filled('trailers')) {
            foreach ($request->trailers as $trailer) {
                if (!empty($trailer['youtube_url'])) {
                    $movie->trailers()->create([
                        'title' => $trailer['title'] ?? 'Trailer',
                        'youtube_url' => $trailer['youtube_url'],
                    ]);
                }
            }
        }

        return redirect()->route('admin.movies.index')->with('success', 'Movie created.');
    }

    public function show(Movie $movie)
    {
        $movie->load('posters', 'genres', 'actors', 'directors', 'trailers', 'reviews');
        return view('admin.movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', [
            'movie' => $movie->load('genres', 'actors', 'directors', 'posters', 'trailers'),
            'genres' => Genre::all(),
            'actors' => Actor::all(),
            'directors' => Director::all(),
        ]);
    }

    public function update(Request $request, Movie $movie)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'duration' => 'nullable|integer',
            'rating' => 'nullable|numeric|min:0|max:10',
            'genres' => 'array',
            'actors' => 'array',
            'directors' => 'array',
            'poster' => 'nullable|image|max:2048',
            'trailers' => 'array',
            'trailers.*.title' => 'nullable|string|max:255',
            'trailers.*.youtube_url' => 'nullable|url',
        ]);

        $movie->update($data);
        $movie->genres()->sync($request->input('genres', []));
        $movie->actors()->sync($request->input('actors', []));
        $movie->directors()->sync($request->input('directors', []));

        if ($request->hasFile('poster')) {
            $oldPoster = $movie->posters->first();
            if ($oldPoster) {
                Storage::disk('public')->delete($oldPoster->image_url);
                $oldPoster->delete();
            }

            $path = $request->file('poster')->store('posters', 'public');
            $movie->posters()->create(['image_url' => $path]);
        }

        // Replace trailers
        $movie->trailers()->delete();
        if ($request->filled('trailers')) {
            foreach ($request->trailers as $trailer) {
                if (!empty($trailer['youtube_url'])) {
                    $movie->trailers()->create([
                        'title' => $trailer['title'] ?? 'Trailer',
                        'youtube_url' => $trailer['youtube_url'],
                    ]);
                }
            }
        }

        return redirect()->route('admin.movies.index')->with('success', 'Movie updated.');
    }

    public function destroy(Movie $movie)
    {
        foreach ($movie->posters as $poster) {
            Storage::disk('public')->delete($poster->image_url);
            $poster->delete();
        }

        $movie->trailers()->delete();
        $movie->genres()->detach();
        $movie->actors()->detach();
        $movie->directors()->detach();
        $movie->delete();

        return redirect()->route('admin.movies.index')->with('success', 'Movie deleted.');
    }
}
