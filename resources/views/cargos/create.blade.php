@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-box me-2"></i>New Shipment</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('cargos.store') }}" method="POST">
                @csrf
                
                <div class="row g-3">
                    <!-- Cargo Type -->
                    <div class="col-md-6">
                        <label class="form-label">Cargo Type</label>
                        <select name="type" class="form-select" required>
                            <option value="">Select Cargo Type</option>
                            <option value="Electronics" {{ old('type') == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                            <option value="Machinery" {{ old('type') == 'Machinery' ? 'selected' : '' }}>Machinery</option>
                            <option value="Petroleum" {{ old('type') == 'Petroleum' ? 'selected' : '' }}>Petroleum</option>
                            <option value="Grains" {{ old('type') == 'Grains' ? 'selected' : '' }}>Grains</option>
                            <option value="Vehicles" {{ old('type') == 'Vehicles' ? 'selected' : '' }}>Vehicles</option>
                        </select>
                        @error('type')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Weight -->
                    <div class="col-md-6">
                        <label class="form-label">Weight (kg)</label>
                        <input type="number" name="weight" 
                               class="form-control" 
                               value="{{ old('weight') }}"
                               min="1" 
                               required>
                        @error('weight')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Ship Selection -->
                    <div class="col-md-6">
                        <label class="form-label">Select Ship</label>
                        <select name="ship_id" class="form-select" required>
                            <option value="">Choose Ship</option>
                            @foreach($ships as $ship)
                            <option value="{{ $ship->id }}" 
                                {{ old('ship_id') == $ship->id ? 'selected' : '' }}>
                                {{ $ship->name }} ({{ $ship->type }})
                            </option>
                            @endforeach
                        </select>
                        @error('ship_id')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- WYSIWYG Editor -->
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <input id="description" type="hidden" name="description">
                        <trix-editor input="description" 
                                    class="trix-content form-control @error('description') is-invalid @enderror"
                                    placeholder="Enter cargo details..."></trix-editor>
                    </div>

                    <!-- Form Actions -->
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Create Shipment
                        </button>
                        <a href="{{ route('cargos.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
@endpush
@endsection