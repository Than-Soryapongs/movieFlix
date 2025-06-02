@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="p-4 rounded shadow" style="background-color: #111; color: #eee;">
        <h2 class="mb-4" style="color: #e50914;">{{ $movie->title }}</h2>

        <div class="row">
            <!-- Poster & Basic Info -->
            <div class="col-md-4">
                @if($movie->posters->first())
                    <div class="">
                        <img src="{{ asset('storage/' . $movie->posters->first()->image_url) }}"
                        alt="{{ $movie->title }}"
                        class="img-fluid mb-3 shadow-sm border border-danger justify-content-center align-items-center"
                        style="width: 300px; height: 350px; object-fit: cover;">
                    </div>
                @endif

                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-dark text-white border-0">
                        <strong class="text-danger">Release Date:</strong>
                        {{ $movie->release_date ? \Carbon\Carbon::parse($movie->release_date)->format('M d, Y') : 'N/A' }}
                    </li>
                    <li class="list-group-item bg-dark text-white border-0">
                        <strong class="text-danger">Duration:</strong> {{ $movie->duration ?? 'N/A' }} minutes
                    </li>
                    <li class="list-group-item bg-dark text-white border-0">
                        <strong class="text-danger">Rating:</strong> {{ $movie->rating ?? 'N/A' }}
                    </li>
                    <li class="list-group-item bg-dark text-white border-0">
                        <strong class="text-danger">Genres:</strong>
                        @forelse($movie->genres as $genre)
                            <span class="badge bg-danger me-1">{{ $genre->name }}</span>
                        @empty
                            <span class="text-muted">None</span>
                        @endforelse
                    </li>
                </ul>
            </div>

            <!-- Info Sections -->
            <div class="col-md-8">
                {{-- Description --}}
                <div class="mb-4">
                    <h4 class="text-danger border-bottom border-danger pb-2">Description</h4>
                    <p class="fst-italic">{{ $movie->description ?? 'No description available.' }}</p>
                </div>

                {{-- Actors --}}
                <div class="mb-4">
                    <h4 class="text-danger border-bottom border-danger pb-2">Actors</h4>
                    @if($movie->actors->count())
                        <ul class="list-unstyled">
                            @foreach($movie->actors as $actor)
                                <li>
                                    <i class="bi bi-person-fill text-danger"></i> 
                                    {{ $actor->name }}
                                    @if($actor->pivot->role)
                                        <span class="text-muted">as {{ $actor->pivot->role }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No actors listed.</p>
                    @endif
                </div>

                {{-- Directors --}}
                <div class="mb-4">
                    <h4 class="text-danger border-bottom border-danger pb-2">Directors</h4>
                    @if($movie->directors->count())
                        <ul class="list-unstyled">
                            @foreach($movie->directors as $director)
                                <li>
                                    <i class="bi bi-person-video2 text-danger"></i> {{ $director->name }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No directors listed.</p>
                    @endif
                </div>

                {{-- Trailers --}}
                <div class="mb-4">
                    <h4 class="text-danger border-bottom border-danger pb-2">Trailers</h4>
                    @forelse($movie->trailers as $trailer)
                        @php
                            preg_match('/v=([^&]+)/', $trailer->youtube_url, $matches);
                            $videoId = $matches[1] ?? null;
                        @endphp

                        @if($videoId)
                            <div class="mb-3">
                                <h6 class="text-light">{{ $trailer->title ?? 'Trailer' }}</h6>
                                <div class="ratio ratio-16x9 border border-danger rounded shadow">
                                    <iframe 
                                        src="https://www.youtube.com/embed/{{ $videoId }}" 
                                        frameborder="0" allowfullscreen></iframe>
                                </div>
                            </div>
                        @endif
                    @empty
                        <p class="text-muted">No trailers available.</p>
                    @endforelse
                </div>

                {{-- Reviews --}}
                <div class="mb-4">
                    <h4 class="text-danger border-bottom border-danger pb-2">Reviews</h4>

                    {{-- Existing Reviews --}}
                    @if($movie->reviews->count())
                        <ul class="list-group mb-4">
                            @foreach($movie->reviews as $review)
                                <li class="list-group-item bg-dark text-white border-danger">
                                    <strong>
                                        @if ($review->user && $review->user->avatar)
                                            <img src="{{ asset('storage/' . $review->user->avatar) }}" alt="Avatar" width="20" height="20" class="rounded-circle me-1" style="vertical-align: middle;">
                                        @else
                                            <i class="bi bi-person-circle me-1"></i>
                                        @endif
                                        {{ $review->user->name ?? $review->user_name }}
                                    </strong>
                                    <span class="text-warning">★ {{ $review->rating }}/10</span>
                                    <p class="mb-0">{{ $review->comment }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No reviews yet.</p>
                    @endif

                    {{-- Add New Review --}}
                    @auth
                        <div class="card bg-dark text-white border border-success">
                            <div class="card-body">
                                <h5 class="card-title text-success">Leave a Review</h5>

                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                {{-- Validation Errors --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('reviews.store', $movie->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="rating" class="form-label">Rating (1–10)</label>
                                        <input type="number" name="rating" id="rating" class="form-control bg-dark text-white border-secondary"
                                            min="1" max="10" required value="{{ old('rating') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Comment</label>
                                        <textarea name="comment" id="comment" rows="3" class="form-control bg-dark text-white border-secondary"
                                                placeholder="Write your review...">{{ old('comment') }}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-success">Submit Review</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <p class="text-muted">Please <a href="{{ route('login') }}" class="text-warning">log in</a> to leave a review.</p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
