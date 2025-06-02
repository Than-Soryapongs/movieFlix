@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="p-5 bg-white rounded shadow-sm text-center">
        <h1 class="mb-4 fw-bold text-primary">Admin Dashboard</h1>
        <p class="lead fs-5">Welcome back, <strong>{{ Auth::user()->name }}</strong> 👋</p>

        @if (Auth::user()->avatar)
            <div class="mt-4 d-flex justify-content-center">
                <img 
                    src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                    alt="Avatar of {{ Auth::user()->name }}" 
                    class="rounded-circle border border-3 border-primary"
                    width="140" 
                    height="140"
                    style="object-fit: cover;"
                >
            </div>
        @else
            <div class="mt-4">
                <i class="bi bi-person-circle text-secondary" style="font-size: 140px;"></i>
            </div>
        @endif
    </div>
</div>
@endsection
