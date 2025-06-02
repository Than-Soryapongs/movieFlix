@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Actors</h2>
        <a href="{{ route('admin.actors.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add Actor
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Bio</th>
                    <th>DOB</th>
                    <th style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($actors as $actor)
                    <tr>
                        <td>{{ $actor->name }}</td>
                        <td title="{{ $actor->bio }}">{{ Str::limit($actor->bio, 60) }}</td>
                        <td>{{ $actor->dob }}</td>
                        <td>
                            <a href="{{ route('admin.actors.edit', $actor) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.actors.destroy', $actor) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-3">No actors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
