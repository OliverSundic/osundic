@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-plus me-2"></i>Add New Ship</h4>
                <a href="{{ route('admin.ships.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.ships.store') }}" 
                  method="POST" enctype="multipart/form-data">
                @csrf
                
                @include('components.ship.form-inputs')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Create Ship
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection