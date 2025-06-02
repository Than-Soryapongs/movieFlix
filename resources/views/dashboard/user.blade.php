@extends('layouts.app') {{-- Adjust if you use a different layout for users --}}

@section('content')
<style>
    /* Container background and card style */
    .dashboard-card {
        background: #121212; /* very dark background */
        border: 2px solid #dc3545; /* bootstrap red border */
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 0 15px rgba(220, 53, 69, 0.5);
        color: #fff;
        max-width: 480px;
        margin: 2rem auto;
    }

    .dashboard-card h1 {
        color: #dc3545;
        font-weight: 900;
        letter-spacing: 1.5px;
        text-align: center;
        margin-bottom: 2rem;
        text-shadow: 0 0 10px #dc3545;
    }

    .avatar-wrapper {
        text-align: center;
        margin-bottom: 1.8rem;
    }

    .avatar-wrapper img {
        width: 130px;
        height: 130px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #dc3545;
        box-shadow: 0 0 10px #dc3545;
        transition: transform 0.3s ease;
    }
    .avatar-wrapper img:hover {
        transform: scale(1.05);
    }

    .user-info p {
        font-size: 1.1rem;
        margin-bottom: 0.7rem;
        border-bottom: 1px solid #dc3545;
        padding-bottom: 0.5rem;
    }

    .btn-outline-primary {
        color: #dc3545;
        border-color: #dc3545;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .btn-outline-primary:hover {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-danger {
        background-color: #a71d2a;
        border-color: #a71d2a;
        transition: background-color 0.3s ease;
    }
    .btn-danger:hover {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-group {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 2rem;
    }

    /* Success alert styling */
    .alert-success {
        background-color: #1b2a2f;
        border-color: #dc3545;
        color: #dc3545;
        font-weight: 600;
        max-width: 480px;
        margin: 1rem auto 0 auto;
        box-shadow: 0 0 10px #dc3545;
    }
</style>

<div class="dashboard-card shadow-sm">
    <h1>User Dashboard</h1>

    @if ($user->avatar)
        <div class="avatar-wrapper">
            <img 
                src="{{ asset('storage/' . $user->avatar) }}" 
                alt="Avatar of {{ $user->name }}" 
                loading="lazy"
            >
        </div>
    @endif

    <div class="user-info">
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
    </div>

    <div class="btn-group">
        <a href="{{ route('user.account.edit') }}" class="btn btn-outline-primary px-4 py-2 fw-semibold rounded-pill">Edit Profile</a>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger px-4 py-2 fw-semibold rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
            Delete Account
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert" id="success-alert">
            {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" action="{{ route('user.account.destroy') }}">
        @csrf
        @method('DELETE')
        <div class="modal-content bg-dark text-white border-danger">
            <div class="modal-header border-danger">
                <h5 class="modal-title" id="deleteAccountModalLabel" style="color:#dc3545;">Confirm Account Deletion</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete your account? This action <strong>cannot</strong> be undone.
            </div>
            <div class="modal-footer border-danger">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Yes, Delete My Account</button>
            </div>
        </div>
    </form>
  </div>
</div>

<script>
    setTimeout(() => {
        const alert = document.getElementById('success-alert');
        if (alert) {
            let alertInstance = bootstrap.Alert.getOrCreateInstance(alert);
            alertInstance.close();
        }
    }, 5000);
</script>
@endsection
