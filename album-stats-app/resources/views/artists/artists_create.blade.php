@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Add New Artist</h3>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('artists.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Artist Name</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>

                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('artists.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection