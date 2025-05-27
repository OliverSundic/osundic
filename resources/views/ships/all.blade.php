@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4">Our Fleet</h1>
        <p class="lead">Explore our modern shipping vessels</p>
    </div>

    <div class="row g-4">
        @foreach($ships as $ship)
        <div class="col-md-6 col-lg-4">
            <div class="card ship-card h-100 shadow-sm">
                @if($ship->image_path)
                <img src="{{ asset('storage/' . $ship->image_path) }}" 
                     class="card-img-top" 
                     alt="{{ $ship->name }}"
                     style="height: 200px; object-fit: cover;">
                @else
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                     style="height: 200px;">
                    <i class="fas fa-ship fa-4x text-secondary"></i>
                </div>
                @endif
                
                <div class="card-body">
                    <h5 class="card-title">{{ $ship->name }}</h5>
                    <p class="card-text">
                        <span class="badge bg-primary">{{ $ship->type }}</span>
                        <span class="text-muted ms-2">{{ number_format($ship->capacity) }} TEU</span>
                    </p>
                </div>
                
                <div class="card-footer bg-transparent">
                    <a href="{{ route('ships.show', $ship) }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-info-circle me-1"></i> View Details
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection

@push('styles')
<style>
    .ship-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .ship-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .card-img-top {
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }
</style>
@endpush