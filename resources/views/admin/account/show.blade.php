@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="p-4 bg-white rounded shadow-sm">
        <h1 class="mb-4 fw-bold text-primary">Admin Profile</h1>

        @if ($admin->avatar)
            <div class="mb-4">
                <img 
                    src="{{ asset('storage/' . $admin->avatar) }}" 
                    alt="Avatar of {{ $admin->name }}" 
                    class="rounded-circle border border-3 border-primary"
                    width="120" 
                    height="120"
                    style="object-fit: cover;"
                >
            </div>
        @endif

        <p><strong>Name:</strong> {{ $admin->name }}</p>
        <p><strong>Email:</strong> {{ $admin->email }}</p>

        <div class="mt-4 d-flex gap-3">
            <a href="{{ route('admin.account.edit') }}" class="btn btn-outline-primary">Edit Profile</a>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                Delete Account
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert" id="success-alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" action="{{ route('admin.account.destroy') }}">
        @csrf
        @method('DELETE')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">Confirm Account Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete your account? This action cannot be undone.
            </div>
            <div class="modal-footer">
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
