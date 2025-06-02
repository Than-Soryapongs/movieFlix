@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Edit User</h2>

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label fw-semibold">Role</label>
            <select id="role" name="role" class="form-select" required>
                <option value="user" @if($user->role == 'user') selected @endif>User</option>
                {{-- Add other roles here if applicable --}}
            </select>
        </div>

        <div class="mb-3">
            <label for="avatar" class="form-label fw-semibold">Profile Image</label>
            <input type="file" id="avatar" name="avatar" class="form-control" accept="image/*">
        </div>

        @if ($user->avatar)
        <div class="mb-3">
            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="rounded-circle border border-secondary" width="100" height="100" style="object-fit: cover;">
        </div>
        @endif

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
