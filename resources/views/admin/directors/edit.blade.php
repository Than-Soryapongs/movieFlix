@extends('layouts.admin')

@section('content')
    <h4>{{ isset($director) ? 'Edit' : 'Create' }} Director</h4>
    <form method="POST" action="{{ isset($director) ? route('admin.directors.update', $director) : route('admin.directors.store') }}">
        @csrf
        @if(isset($director)) @method('PUT') @endif

        @include('admin.directors._form')
    </form>
@endsection
