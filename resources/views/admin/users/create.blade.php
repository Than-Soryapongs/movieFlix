@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h2>Add New User</h2>
    <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
    @csrf

    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="role" required>
        <option value="user">User</option>
        <option value="editor">Editor</option>
    </select>
    <input type="file" name="avatar" accept="image/*">

    <button type="submit">Create</button>
</form>

</div>
@endsection
