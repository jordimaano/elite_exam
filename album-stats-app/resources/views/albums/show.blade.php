@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $album->name }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Year:</strong> {{ $album->year }}</p>
            <p><strong>Sales:</strong> {{ number_format($album->sales, 2) }}</p>
            <p><strong>Artist:</strong> {{ $album->artist->name ?? 'N/A' }}</p>
            <p><strong>Details:</strong> {{ $album->details ?? 'N/A' }}</p>
            @if ($album->album_cover)
            <p><strong>Album Cover:</strong></p>
            <img src="{{ $album->album_cover }}" alt="Album Cover" class="img-fluid rounded" style="max-width: 300px;">
            @endif

            <div class="mt-4">
                <a href="{{ route('albums.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-primary">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection