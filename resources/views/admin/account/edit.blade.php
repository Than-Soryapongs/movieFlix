@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="p-4 bg-white rounded shadow-sm">
        <h1 class="mb-4 fw-bold text-primary">Edit Admin Account</h1>

        <form method="POST" action="{{ route('admin.account.update') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input 
                    id="name" 
                    name="name" 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    value="{{ old('name', $admin->name) }}" 
                    required
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    value="{{ old('email', $admin->email) }}" 
                    required
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">New Password <small class="text-muted">(leave blank to keep current)</small></label>
                <input 
                    id="password" 
                    name="password" 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    autocomplete="new-password"
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    class="form-control" 
                    autocomplete="new-password"
                >
            </div>

            <!-- Avatar -->
            <div class="mb-3">
                <label for="avatar" class="form-label">Profile Image</label>
                <input 
                    id="avatar" 
                    name="avatar" 
                    type="file" 
                    accept="image/*" 
                    class="form-control @error('avatar') is-invalid @enderror"
                >
                @error('avatar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @if ($admin->avatar)
                    <div class="mt-3">
                        <img 
                            src="{{ asset('storage/' . $admin->avatar) }}" 
                            alt="Current Avatar" 
                            class="rounded-circle border border-primary" 
                            width="100" 
                            height="100" 
                            style="object-fit: cover;"
                        >
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Account</button>
            <a href="{{ route('admin.account.show') }}" class="btn btn-link">Cancel</a>
        </form>
    </div>
</div>

<script>
    // Bootstrap form validation example
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endsection
