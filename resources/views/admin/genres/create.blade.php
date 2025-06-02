@extends('layouts.admin')

@section('content')
    <h4>{{ isset($genre) ? 'Edit' : 'Create' }} Genre</h4>
    <form method="POST"
          action="{{ isset($genre) ? route('admin.genres.update', $genre) : route('admin.genres.store') }}">
        @csrf
        @if(isset($genre)) @method('PUT') @endif

        @include('admin.genres._form')
    </form>
@endsection
