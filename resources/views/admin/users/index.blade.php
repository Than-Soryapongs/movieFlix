@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4 fw-bold text-danger">All Users</h2>

    <div class="table-responsive bg-white rounded shadow-sm p-3">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="width: 70px;">Avatar</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col" style="width: 120px;">Role</th>
                    <th scope="col" style="width: 160px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>
                        @if ($user->avatar)
                            <img 
                                src="{{ asset('storage/' . (Str::startsWith($user->avatar, 'avatars/') ? $user->avatar : 'avatars/' . $user->avatar)) }}" 
                                alt="{{ $user->name }}'s Avatar" 
                                class="rounded-circle border border-secondary"
                                width="50" height="50" style="object-fit: cover;"
                            >
                        @else
                            <img 
                                src="{{ asset('images/default-avatar.png') }}" 
                                alt="Default Avatar" 
                                class="rounded-circle border border-secondary" 
                                width="50" height="50"
                                style="object-fit: cover;"
                            >
                        @endif
                    </td>
                    <td class="text-start">{{ $user->name }}</td>
                    <td class="text-start">{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm mb-2 d-block">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>

                        <button 
                            class="btn btn-danger btn-sm d-block w-100" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteModal" 
                            data-userid="{{ $user->id }}" 
                            data-username="{{ $user->name }}"
                        >
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                @endforeach

                @if ($users->isEmpty())
                <tr>
                    <td colspan="5" class="text-center text-muted">No users found.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="deleteUserForm">
      @csrf
      @method('DELETE')

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirm User Deletion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete user <strong id="deleteUserName"></strong>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Yes, Delete</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Bootstrap Icons CDN for icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Bootstrap JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var deleteModal = document.getElementById('deleteModal');
    var deleteUserName = document.getElementById('deleteUserName');
    var deleteUserForm = document.getElementById('deleteUserForm');

    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var userId = button.getAttribute('data-userid');
        var userName = button.getAttribute('data-username');

        // Update modal content
        deleteUserName.textContent = userName;

        // Update form action URL with the user ID
        deleteUserForm.action = '/admin/users/' + userId;
    });
});
</script>
@endsection
