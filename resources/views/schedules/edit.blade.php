@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Schedule</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('schedules.update', $schedule) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Ship</label>
                        <select name="ship_id" class="form-select" required>
                            @foreach($ships as $ship)
                            <option value="{{ $ship->id }}" 
                                {{ $schedule->ship_id == $ship->id ? 'selected' : '' }}>
                                {{ $ship->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Departure Port</label>
                        <select name="departure_port_id" class="form-select" required>
                            @foreach($ports as $port)
                            <option value="{{ $port->id }}" 
                                {{ $schedule->departure_port_id == $port->id ? 'selected' : '' }}>
                                {{ $port->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Arrival Port</label>
                        <select name="arrival_port_id" class="form-select" required>
                            @foreach($ports as $port)
                            <option value="{{ $port->id }}" 
                                {{ $schedule->arrival_port_id == $port->id ? 'selected' : '' }}>
                                {{ $port->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Departure Time</label>
                        <input type="datetime-local" name="departure_time" 
                               class="form-control" 
                               value="{{ $schedule->departure_time }}" 
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Arrival Time</label>
                        <input type="datetime-local" name="arrival_time" 
                               class="form-control" 
                               value="{{ $schedule->arrival_time }}" 
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Price (USD)</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="price" 
                                   class="form-control @error('price') is-invalid @enderror"
                                   step="0.01" min="0"
                                   value="{{ old('price', $shippingSchedule->price ?? '') }}">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Schedule
                        </button>
                        <a href="{{ route('schedules.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection