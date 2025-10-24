@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Artists List</h1>
        <a href="/" class="btn btn-secondary btn-sm">Back to Home</a>
    </div>

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
                    </tr>
                </thead>
                <tbody>
                    @foreach($artists as $artist)
                    <tr>
                        <td>{{ $artist->id }}</td>
                        <td>{{ $artist->code}}</td>
                        <td>{{ $artist->name }}</td>
                        <td>{{ $artist->created_at->format('Y-m-d') }}</td>
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