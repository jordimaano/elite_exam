@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Add New Album</h2>

    <form action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="number" name="year" class="form-control" value="{{ old('year') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sales</label>
            <input type="number" step="0.01" name="sales" class="form-control" value="{{ old('sales') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Details</label>
            <textarea name="details" class="form-control">{{ old('details') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Artist</label>
            <select name="artist_id" class="form-select" required>
                <option value="">-- Select Artist --</option>
                @foreach($artists as $artist)
                <option value="{{ $artist->id }}" {{ old('artist_id')==$artist->id ? 'selected' : '' }}>
                    {{ $artist->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Album Cover</label>
            <input type="file" name="album_cover" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('albums.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection