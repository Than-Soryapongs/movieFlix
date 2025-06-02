@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="p-4 bg-white rounded shadow-sm">
        <h2 class="fw-bold mb-4 text-warning">Edit Movie</h2>

        <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $movie->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $movie->description) }}</textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="release_date" class="form-label">Release Date</label>
                    <input type="date" id="release_date" name="release_date" class="form-control" value="{{ old('release_date', $movie->release_date) }}">
                </div>
                <div class="col-md-4">
                    <label for="duration" class="form-label">Duration (minutes)</label>
                    <input type="number" id="duration" name="duration" class="form-control" value="{{ old('duration', $movie->duration) }}">
                </div>
                <div class="col-md-4">
                    <label for="rating" class="form-label">Rating</label>
                    <input type="number" id="rating" step="0.1" name="rating" class="form-control" min="0" max="10" value="{{ old('rating', $movie->rating) }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="genres" class="form-label">Genres</label>
                <select id="genres" name="genres[]" class="form-select" multiple>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" {{ in_array($genre->id, $movie->genres->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="actors" class="form-label">Actors</label>
                <select id="actors" name="actors[]" class="form-select" multiple>
                    @foreach ($actors as $actor)
                        <option value="{{ $actor->id }}" {{ in_array($actor->id, $movie->actors->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $actor->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="directors" class="form-label">Directors</label>
                <select id="directors" name="directors[]" class="form-select" multiple>
                    @foreach ($directors as $director)
                        <option value="{{ $director->id }}" {{ in_array($director->id, $movie->directors->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $director->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="poster" class="form-label">Change Poster (optional)</label>
                <input type="file" id="poster" name="poster" class="form-control">
            </div>

            {{-- Trailers --}}
            <div class="mb-4">
                <label class="form-label">Trailers</label>
                <div id="trailers-container">
                    @forelse ($movie->trailers as $trailer)
                        <div class="trailer-item mb-2 border rounded p-3">
                            <div class="mb-2">
                                <label class="form-label">Trailer Title</label>
                                <input type="text" name="trailers[{{ $trailer->id }}][title]" class="form-control"
                                    value="{{ old("trailers.{$trailer->id}.title", $trailer->title) }}" placeholder="Trailer title">
                            </div>
                            <div>
                                <label class="form-label">YouTube URL</label>
                                <input type="url" name="trailers[{{ $trailer->id }}][youtube_url]" class="form-control"
                                    value="{{ old("trailers.{$trailer->id}.youtube_url", $trailer->youtube_url) }}" placeholder="https://youtube.com/...">
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No trailers available.</p>
                    @endforelse
                </div>
            </div>

            <button type="submit" class="btn btn-warning">Update Movie</button>
        </form>
    </div>
</div>
@endsection
