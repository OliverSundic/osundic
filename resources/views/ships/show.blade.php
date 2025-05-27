@extends('layouts.app')

@section('content')
<div class="main-content">
    <!-- Hero Section -->
    <div class="bg-primary text-white py-5">
        <div class="container">
            <h1 class="display-4">{{ $ship->name }}</h1>
            <p class="lead">{{ $ship->type }} with capacity of {{ number_format($ship->capacity) }} TEU</p>
        </div>
    </div>

    <!-- Ship Details -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-body text-center">
                        @if($ship->image_url)
                            <img src="{{ $ship->image_url }}" alt="{{ $ship->name }}" class="img-fluid rounded mb-3">
                        @else
                            <div class="bg-light p-5 text-center">
                                <i class="fas fa-ship fa-5x text-secondary"></i>
                                <p class="mt-3">No image available</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Ship Details</h5>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">Ship Name</dt>
                            <dd class="col-sm-8">{{ $ship->name }}</dd>

                            <dt class="col-sm-4">Type</dt>
                            <dd class="col-sm-8">{{ $ship->type }}</dd>

                            <dt class="col-sm-4">Capacity</dt>
                            <dd class="col-sm-8">{{ number_format($ship->capacity) }} TEU</dd>

                            @if($ship->featured)
                            <dt class="col-sm-4">Status</dt>
                            <dd class="col-sm-8"><span class="badge bg-success">Featured</span></dd>
                            @endif
                        </dl>

                        <h5 class="mt-4">Current Cargo</h5>
                        <ul class="list-group">
                            @forelse($ship->cargos as $cargo)
                                <li class="list-group-item">
                                    {{ $cargo->type }} ({{ $cargo->weight }} kg)
                                </li>
                            @empty
                                <li class="list-group-item">No cargo assigned</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection