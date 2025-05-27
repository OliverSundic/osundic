@extends('layouts.app')

@section('content')
<div class="main-content">
    <!-- Hero Section -->
    <div class="bg-primary text-white py-5">
        <div class="container">
            <h1 class="display-4">{{ $user->name }}'s Profile</h1>
            <p class="lead">Manage your account details and preferences</p>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="mb-3 position-relative">
                    @if($user->profile_image)
                        <img src="{{ $user->profile_image_url }}" 
                             class="img-thumbnail rounded-circle" 
                             alt="Profile Image"
                             style="width: 200px; height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 200px; height: 200px;">
                            <i class="fas fa-user fa-5x text-secondary"></i>
                        </div>
                    @endif
                    
                    <form action="{{ route('profile.image.update') }}" 
                          method="POST" 
                          enctype="multipart/form-data"
                          class="mt-3">
                        @csrf
                        <div class="input-group">
                            <input type="file" 
                                   name="profile_image" 
                                   class="form-control" 
                                   accept="image/*">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload me-1"></i> Upload
                            </button>
                        </div>
                        @error('profile_image')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Account Details</h5>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">Email Address</dt>
                            <dd class="col-sm-8">{{ $user->email }}</dd>

                            <dt class="col-sm-4">Account Created</dt>
                            <dd class="col-sm-8">{{ $user->created_at->format('M j, Y') }}</dd>

                            <dt class="col-sm-4">Last Login</dt>
                            <dd class="col-sm-8">{{ $user->last_login_at}}</dd>

                            <dt class="col-sm-4">Account Type</dt>
                            <dd class="col-sm-8">
                                <span class="badge bg-dark">{{ ucfirst($user->role) }}</span>
                            </dd>
                        </dl>

                        @if($user->role === 'admin')
                        <div class="alert alert-info mt-4">
                            <h5><i class="fas fa-shield-alt me-2"></i>Administrator Privileges</h5>
                            <p class="mb-0">You have full access to system configuration and user management.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection