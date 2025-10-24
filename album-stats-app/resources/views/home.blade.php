@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center gap-3 mb-4">
        <a href="{{ route('artists.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-person-lines-fill"></i> View Artists
        </a>

        <a href="{{ route('albums.index') }}" class="btn btn-outline-success">
            <i class="bi bi-disc-fill"></i> View Albums
        </a>
    </div>
    <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-md-12 col-lg-12">
            <h3 class="text-center mb-4 fw-bold">Artist Album Statistics</h3>

            <div class="row g-4">
                @forelse ($artistTotalAlbum as $artist)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold text-primary">{{ $artist->name }}</h5>

                            <p class="card-text mb-1 text-muted">
                                <strong>Total Albums:</strong> {{ $artist->albums_count }}
                            </p>

                            <p class="card-text mb-1 text-muted">
                                <strong>Total Album Sales:</strong>
                            </p>
                            <h4 class="fw-bold text-success">
                                {{ number_format($artist->albums_sum_sales ?? 0, 2) }}
                            </h4>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        No artist data found.
                    </div>
                </div>
                @endforelse
            </div>
        </div>
        <hr>
        <!-- Card 2 -->
        <div class="col-md-12 col-lg-12">
            <div class="card h-100 shadow-sm border-0">
                <h3 class="text-center mb-4 fw-bold">Combined Album Sales Per Artist</h3>

                <div class="row g-4">
                    @forelse ($artists as $artist)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">{{ $artist->name }}</h5>
                                <p class="card-text text-muted mb-2">
                                    Total Album Sales:
                                </p>
                                <h4 class="text-success fw-bold">
                                    {{ number_format($artist->albums_sum_sales ?? 0, 2) }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            No artists found.
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <hr>
        <!-- Card 3 -->
        <div class="col-md-12 col-lg-12">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <h4 class="card-title fw-bold text-primary mb-3">Top Artist</h4>

                    <div class="mb-2">
                        <span class="fw-semibold text-muted">Name:</span>
                        <span class="fw-bold text-dark">{{ $topArtist->name }}</span>
                    </div>

                    <div class="mb-2">
                        <span class="fw-semibold text-muted">Code:</span>
                        <span class="fw-bold text-dark">{{ $topArtist->code }}</span>
                    </div>

                    <div class="mt-3">
                        <span class="fw-semibold text-muted">Total Sales:</span>
                        <h4 class="fw-bold text-success mb-0">
                            {{ number_format($topArtist->albums_sum_sales ?? 0, 2) }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <!-- Card 4 -->
        <div class="col-md-12 col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="card-title fw-bold text-center mb-4">
                        Searched Artist — <span class="text-primary">{{ $monstaX->name }}</span>
                    </h4>

                    @if ($monstaX->albums->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Album Cover</th>
                                    <th scope="col">Album Name</th>
                                    <th scope="col">Year</th>
                                    <th scope="col">Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($monstaX->albums as $album)
                                <tr>
                                    <td>
                                        @if ($album->album_cover)
                                        <img src="{{ asset('images/' . $album->album_cover) }}" alt="{{ $album->name }}"
                                            width="80" class="rounded">
                                        @else
                                        <span class="text-muted">No image</span>
                                        @endif
                                    </td>
                                    <td>{{ $album->name }}</td>
                                    <td>{{ $album->year }}</td>
                                    <td>{{ number_format($album->sales, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-muted text-center mb-0">No albums found for this artist.</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection