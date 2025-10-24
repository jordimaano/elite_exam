@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="text-center">
            <h1>Welcome to Album Statistics App</h1>
        </div>
    </div>

    <div class="d-flex justify-content-center gap-3 mb-4">
        <a href="{{ route('artists.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-person-lines-fill"></i> View Artists
        </a>

        <a href="{{ route('albums.index') }}" class="btn btn-outline-success">
            <i class="bi bi-disc-fill"></i> View Albums
        </a>
        <a href="{{ route('home') }}" class="btn btn-outline-success">
            <i class="bi bi-speedometer2"></i> View Dashboard
        </a>
    </div>
</div>
@endsection