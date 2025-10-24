@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Edit Artist</h3>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('artists.update', $artist->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Artist Name</label>
                    <input type="text" name="name" class="form-control" required
                        value="{{ old('name', $artist->name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Code</label>
                    <input type="text" name="code" class="form-control" value="{{ old('code', $artist->code) }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('artists.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection