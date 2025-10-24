@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Album</h2>

    <form action="{{ route('albums.update', $album->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="number" name="year" class="form-control" value="{{ old('year', $album->year) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $album->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sales</label>
            <input type="number" step="0.01" name="sales" class="form-control"
                value="{{ old('sales', $album->sales) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Details</label>
            <textarea name="details" class="form-control">{{ old('details', $album->details) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Artist</label>
            <select name="artist_id" class="form-select" required>
                @foreach($artists as $artist)
                <option value="{{ $artist->id }}" {{ $album->artist_id == $artist->id ? 'selected' : '' }}>
                    {{ $artist->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Album Cover</label><br>
            @if($album->album_cover)
            <img src="{{ asset('images/' . $album->album_cover) }}" alt="Album Cover" width="150" class="mb-2">
            @endif
            <input type="file" name="album_cover" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('albums.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection