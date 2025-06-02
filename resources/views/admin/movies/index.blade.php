@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-danger text-center">Movies Management</h1>

        <div class="text-end mb-3">
            <a href="{{ route('admin.movies.create') }}" class="btn btn-danger">
                <i class="bi bi-plus-circle"></i> Add Movie
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @forelse ($movies as $movie)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0" style="background-color: #1a1a1a; color: #fff;">
                        @if ($movie->posters->first())
                            <img src="{{ asset('storage/' . $movie->posters->first()->image_url) }}" 
                                 class="card-img-top" 
                                 alt="{{ $movie->title }}" 
                                 style="height: 250px; object-fit: cover; border-bottom: 4px solid #dc3545;">
                        @else
                            <img src="https://via.placeholder.com/300x450?text=No+Image" 
                                 class="card-img-top" 
                                 alt="No Image" 
                                 style="height: 250px; object-fit: cover; border-bottom: 4px solid #dc3545;">
                        @endif

                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title text-danger">{{ $movie->title }}</h5>
                                <p class="card-text text-light" style="font-size: 0.9rem;">
                                    {{ Str::limit($movie->description, 100, '...') }}
                                </p>
                            </div>
                            <div class="mt-3 d-flex justify-content-between flex-wrap gap-1">
                                <a href="{{ route('movies.show', $movie) }}" class="btn btn-sm btn-outline-light">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <a href="{{ route('admin.movies.edit', $movie) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.movies.destroy', $movie) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-white">No movies found.</p>
            @endforelse
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $movies->links() }}
        </div>
    </div>
@endsection
