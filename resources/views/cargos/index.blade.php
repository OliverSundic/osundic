@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-boxes me-2"></i>My Shipments</h4>
                <a href="{{ route('cargos.create') }}" class="btn btn-light">
                    <i class="fas fa-plus me-1"></i> New Shipment
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Type</th>
                            <th>Weight</th>
                            <th>Ship</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cargos as $cargo)
                        <tr>
                            <td>{{ $cargo->type }}</td>
                            <td>{{ number_format($cargo->weight) }} kg</td>
                            <td>{{ $cargo->ship->name ?? 'N/A' }}</td>
                            <td>{!! Str::limit($cargo->description, 50) !!}</td>
                            <td>
                                <a href="{{ route('cargos.edit', $cargo) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('cargos.destroy', $cargo) }}" 
                                      method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Delete this shipment?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No shipments found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{ $cargos->links() }}
        </div>
    </div>
</div>
@endsection