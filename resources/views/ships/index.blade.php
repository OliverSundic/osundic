@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-ship me-2"></i>Manage Ships</h4>
                <a href="{{ route('admin.ships.create') }}" class="btn btn-light">
                    <i class="fas fa-plus me-1"></i> New Ship
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Capacity</th>
                            <th>Cargo</th>
                            <th>Featured</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ships as $ship)
                        <tr>
                            <td>{{ $ship->name }}</td>
                            <td>{{ $ship->type }}</td>
                            <td>{{ number_format($ship->capacity) }} TEU</td>
                            <td>
                                <ul class="list-unstyled">
                                    @foreach($ship->cargos as $cargo)
                                        <li>{{ $cargo->type }} ({{ $cargo->weight }} kg)</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                @if($ship->featured)
                                    <i class="fas fa-check text-success"></i>
                                @else
                                    <i class="fas fa-times text-danger"></i>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.ships.edit', $ship) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.ships.destroy', $ship) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete this ship?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $ships->links() }}
        </div>
    </div>
</div>
@endsection