@extends('layouts.app')

@section('title', 'Movies')

@section('content')
    <h1 class="mb-4 text-danger">Movies for you</h1>

    <div class="row">
        @foreach($movies as $movie)
            <div class="col-md-3 mb-4">
                <div class="card h-100 border-0" style="background-color: #1a1a1a; color: #f8f9fa; border-radius: 0;">
                    <a href="{{ route('movies.show', $movie->id) }}" style="text-decoration: none; color: inherit;">
                        @if($movie->posters->first())
                            <img src="{{ asset('storage/' . $movie->posters->first()->image_url) }}" 
                                 alt="{{ $movie->title }}" class="card-img-top" 
                                 style="height: 250px; object-fit: cover; border-radius: 0;">
                        @else
                            <img src="https://via.placeholder.com/300x450?text=No+Image" 
                                 alt="No Image" class="card-img-top"
                                 style="height: 250px; object-fit: cover; border-radius: 0;">
                        @endif

                        <div class="card-body px-3 pt-2 pb-3 d-flex flex-column justify-content-between" style="background-color: #1a1a1a;">
                            <div class="mb-2 d-flex flex-wrap gap-1">
                                <span class="badge bg-success text-dark"><i class="bi bi-clock"></i> {{$movie->duration}} mins</span>
                                <span class="badge bg-danger"><i class="bi bi-star-fill"></i> {{ $movie->rating ?? 'N/A' }}</span>
                            </div>

                            <h6 class="card-title text-white mb-1" style="font-weight: 600;">{{ $movie->title }}</h6>

                            <p class="card-text text-light" style="font-size: 0.85rem;">
                                {{ Str::limit($movie->description, 90, '...') }} + More
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $movies->links() }}
    </div>
@endsection
