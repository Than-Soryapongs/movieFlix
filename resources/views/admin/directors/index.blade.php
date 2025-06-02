@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">🎬 Directors</h4>
        <a href="{{ route('admin.directors.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Add Director
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>DOB</th>
                            <th>Biography</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($directors as $director)
                            <tr>
                                <td class="fw-semibold">{{ $director->name }}</td>
                                <td>{{ $director->dob ?? 'N/A' }}</td>
                                <td style="max-width: 300px;">
                                    @php
                                        $shortBio = Str::limit($director->bio, 100);
                                    @endphp
                                    <span class="short-bio d-block">{{ $shortBio }}</span>
                                    <span class="full-bio d-none">{{ $director->bio }}</span>
                                    @if(strlen($director->bio) > 100)
                                        <button class="btn btn-link p-0 text-primary toggle-bio" type="button">+ More</button>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.directors.edit', $director) }}" class="btn btn-sm btn-outline-primary me-1">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form action="{{ route('admin.directors.destroy', $director) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this director?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No directors found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggles = document.querySelectorAll('.toggle-bio');

        toggles.forEach(toggle => {
            toggle.addEventListener('click', function () {
                const row = this.closest('td');
                const shortBio = row.querySelector('.short-bio');
                const fullBio = row.querySelector('.full-bio');

                if (fullBio.classList.contains('d-none')) {
                    shortBio.classList.add('d-none');
                    fullBio.classList.remove('d-none');
                    this.textContent = '- Less';
                } else {
                    fullBio.classList.add('d-none');
                    shortBio.classList.remove('d-none');
                    this.textContent = '+ More';
                }
            });
        });
    });
</script>
@endpush
