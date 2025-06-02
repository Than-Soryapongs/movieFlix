@extends('layouts.app')

@section('content')
<style>
    .edit-account-container {
        max-width: 480px;
        margin: 2rem auto;
        background: #121212;
        padding: 2rem;
        border: 2px solid #dc3545;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(220, 53, 69, 0.5);
        color: #fff;
    }

    .edit-account-container h2 {
        color: #dc3545;
        font-weight: 900;
        letter-spacing: 1.5px;
        text-align: center;
        margin-bottom: 2rem;
        text-shadow: 0 0 10px #dc3545;
    }

    label {
        font-weight: 600;
        color: #dc3545;
    }

    input.form-control,
    input.form-control:focus {
        background-color: #1e1e1e;
        border: 1.5px solid #dc3545;
        color: #fff;
        box-shadow: none;
        transition: border-color 0.3s ease;
    }

    input.form-control:focus {
        border-color: #ff4d4d;
        box-shadow: 0 0 8px #ff4d4d;
        color: #fff;
    }

    .text-muted {
        color: #a33 !important;
    }

    .text-danger {
        color: #ff6b6b !important;
        margin-top: 0.3rem;
        font-weight: 600;
    }

    img {
        border-radius: 8px;
        border: 2px solid #dc3545;
        margin-top: 0.5rem;
        box-shadow: 0 0 10px #dc3545;
    }

    .btn-success {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #fff;
        font-weight: 700;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        transition: background-color 0.3s ease;
    }
    .btn-success:hover {
        background-color: #b02a37;
        border-color: #b02a37;
        color: #fff;
    }

    .btn-secondary {
        background-color: #2a2a2a;
        border-color: #444;
        color: #dc3545;
        font-weight: 600;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        margin-left: 1rem;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .btn-secondary:hover {
        background-color: #dc3545;
        color: #fff;
        border-color: #b02a37;
    }
</style>

<div class="edit-account-container shadow-sm">
    <h2>Edit Account</h2>

    <form action="{{ route('user.account.update') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input value="{{ old('name', $user->name) }}" type="text" name="name" id="name" class="form-control" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input value="{{ old('email', $user->email) }}" type="email" name="email" id="email" class="form-control" required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" name="password" id="password" class="form-control" autocomplete="new-password">
            <small class="text-muted">Leave blank if you don't want to change it.</small>
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="new-password">
        </div>

        <div class="mb-3">
            <label for="avatar" class="form-label">Avatar</label>
            <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*">
            @if ($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Current Avatar" width="100" height="100" loading="lazy">
            @endif
            @error('avatar') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-success" type="submit">Save Changes</button>
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
