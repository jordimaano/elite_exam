@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Artists List</h1>
        <a href="/" class="btn btn-secondary btn-sm">Back to Home</a>
        <a href="{{ route('artists.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add New Artist
        </a>
    </div>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            @if($artists->isEmpty())
            <p class="text-center text-muted mb-0">No artists found.</p>
            @else
            <table class="table table-striped table-hover align-middle">

                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($artists as $artist)
                    <tr>
                        <td>{{ $artist->id }}</td>
                        <td>{{ $artist->code}}</td>
                        <td>{{ $artist->name }}</td>
                        <td>{{ $artist->created_at->format('Y-m-d') }}</td>
                        <td class="text-center">
                            <a href="{{ route('artists.show', $artist->id) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i> View
                            </a>
                            <a href="{{ route('artists.edit', $artist->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            <form action="{{ route('artists.destroy', $artist->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this artist?');">
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
            @endif
            <div class="d-flex justify-content-center mt-4">
                {{ $artists->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection