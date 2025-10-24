@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4>{{ $artist->name }}</h4>
            <p><strong>Code:</strong> {{ $artist->code ?? 'N/A' }}</p>
            <p><strong>Created At:</strong> {{ $artist->created_at->format('Y-m-d') }}</p>
            <a href="{{ route('artists.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection