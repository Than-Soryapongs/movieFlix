@extends('layouts.admin')
@section('content')
<h2>Edit Actor</h2>
<form action="{{ route('admin.actors.update', $actor) }}" method="POST">
    @method('PUT')
    @include('admin.actors._form')
</form>
@endsection
