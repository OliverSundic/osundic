@extends('layouts.app')

@section('content')
<section class="hero-section">
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bold mb-4">Modern Maritime Solutions</h1>
        <p class="lead mb-4">Innovative shipping services across global waters</p>
        <a href="/schedules" class="btn btn-lg btn-primary">View Schedules</a>
    </div>
</section>

<!-- Featured Ships -->
<section class="container mb-5">
    <h2 class="text-center mb-5 fw-bold">Featured Vessels</h2>
    <div class="row g-4">
        @foreach($featuredShips as $ship)
        <div class="col-md-6 col-lg-4">
            <div class="ship-card card h-100 shadow">
                @if($ship->featured)
                    <div class="featured-badge text-white">FEATURED</div>
                @endif
                <div class="card-img-top" style="height: 180px; overflow: hidden;">
                    @if($ship->image_url)
                        <img src="{{ $ship->image_url }}" alt="{{ $ship->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div class="h-100 d-flex flex-column justify-content-center align-items-center bg-light">
                            <i class="fas fa-ship fa-3x text-secondary"></i>
                            <small class="text-muted mt-2">No image</small>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $ship->name }}</h5>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-muted mb-1">{{ $ship->type }}</p>
                            <p class="mb-0"><strong>Capacity:</strong> {{ number_format($ship->capacity) }} TEU</p>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="{{ route('ships.show', $ship) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-info-circle me-1"></i> Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection