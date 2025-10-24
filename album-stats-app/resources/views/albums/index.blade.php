@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Album List</h3>
        <a href="{{ route('albums.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add New Album
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            @if($albums->isEmpty())
            <p class="text-center text-muted mb-0">No albums found.</p>
            @else
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Year</th>
                        <th>Name</th>
                        <th>Sales</th>
                        <th>Artist</th>
                        <th>Details</th>
                        <th>Album Cover</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($albums as $album)
                    <tr>
                        <td>{{ $album->id }}</td>
                        <td>{{ $album->year }}</td>
                        <td>{{ $album->name }}</td>
                        <td>{{ number_format($album->sales, 2) }}</td>
                        <td>{{ $album->artist->name ?? 'N/A' }}</td>
                        <td>{{ $album->details ?? '-' }}</td>
                        <td>
                            @if($album->album_cover)
                            <img src="{{ asset('images/' . $album->album_cover) }}" alt="Album Cover" width="80"
                                class="rounded shadow-sm">
                            @else
                            <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('albums.show', $album->id) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i> View
                            </a>
                            <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('albums.destroy', $album->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
                {{ $albums->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection