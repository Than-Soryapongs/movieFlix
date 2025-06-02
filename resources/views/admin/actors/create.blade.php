@extends('layouts.admin')
@section('content')
<h2>Add Actor</h2>
<form action="{{ route('admin.actors.store') }}" method="POST">
    @include('admin.actors._form')
</form>
@endsection
