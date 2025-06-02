@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="p-4 bg-white rounded shadow-sm">
        <h2 class="fw-bold mb-4 text-primary">Add New Movie</h2>

        <form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>

            {{-- Release Info --}}
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="release_date" class="form-label">Release Date</label>
                    <input type="date" id="release_date" name="release_date" class="form-control" value="{{ old('release_date') }}">
                </div>
                <div class="col-md-4">
                    <label for="duration" class="form-label">Duration (minutes)</label>
                    <input type="number" id="duration" name="duration" class="form-control" value="{{ old('duration') }}">
                </div>
                <div class="col-md-4">
                    <label for="rating" class="form-label">Rating</label>
                    <input type="number" id="rating" step="0.1" name="rating" class="form-control" min="0" max="10" value="{{ old('rating') }}">
                </div>
            </div>

            {{-- Genres --}}
            <div class="mb-3">
                <label for="genres" class="form-label">Genres</label>
                <select id="genres" name="genres[]" class="form-select" multiple>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Actors --}}
            <div class="mb-3">
                <label for="actors" class="form-label">Actors</label>
                <select id="actors" name="actors[]" class="form-select" multiple>
                    @foreach ($actors as $actor)
                        <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Directors --}}
            <div class="mb-3">
                <label for="directors" class="form-label">Directors</label>
                <select id="directors" name="directors[]" class="form-select" multiple>
                    @foreach ($directors as $director)
                        <option value="{{ $director->id }}">{{ $director->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Poster --}}
            <div class="mb-4">
                <label for="poster" class="form-label">Poster</label>
                <input type="file" id="poster" name="poster" class="form-control">
            </div>

            {{-- Trailers --}}
            <div class="mb-4">
                <label class="form-label">Trailers</label>
                <div id="trailers-container">
                    <div class="trailer-item mb-2 border rounded p-3">
                        <div class="mb-2">
                            <label class="form-label">Trailer Title</label>
                            <input type="text" name="trailers[0][title]" class="form-control" placeholder="Trailer title">
                        </div>
                        <div>
                            <label class="form-label">YouTube URL</label>
                            <input type="url" name="trailers[0][youtube_url]" class="form-control" placeholder="https://youtube.com/...">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary">Create Movie</button>
        </form>
    </div>
</div>

{{-- JS for dynamic trailer inputs --}}
@push('scripts')
<script>
    let trailerIndex = 1;
    document.getElementById('add-trailer').addEventListener('click', function () {
        const container = document.getElementById('trailers-container');
        const div = document.createElement('div');
        div.classList.add('trailer-item', 'mb-2', 'border', 'rounded', 'p-3');
        div.innerHTML = `
            <div class="mb-2">
                <label class="form-label">Trailer Title</label>
                <input type="text" name="trailers[${trailerIndex}][title]" class="form-control" placeholder="Trailer title">
            </div>
            <div>
                <label class="form-label">YouTube URL</label>
                <input type="url" name="trailers[${trailerIndex}][youtube_url]" class="form-control" placeholder="https://youtube.com/...">
            </div>
        `;
        container.appendChild(div);
        trailerIndex++;
    });
</script>
@endpush
@endsection
