@extends('layouts.app')

@section('content')
<div class="main-content">
    <!-- Hero Section -->
    <div class="bg-primary text-white py-5">
        <div class="container">
            <h1 class="display-4">Contact Us</h1>
            <p class="lead">Get in touch with our shipping team</p>
        </div>
    </div>


    <!-- Contact Content -->
    <div class="container py-5">
        <div class="row g-4">
            <!-- Contact Form (same as before) -->
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>Send us a message</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-1"></i> Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Map and Info -->
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Our Location</h5>
                    </div>
                    <div class="card-body p-0">
                        <!-- OpenStreetMap Container -->
                        <div id="osm-map" style="height: 400px; width: 100%;"></div>
                        
                        <!-- Contact Info -->
                        <div class="p-4">
                            <h6><i class="fas fa-building me-2"></i>Harbor Shipping Co.</h6>
                            <p class="mb-1">Kneza Miloša 20, Belgrade, Serbia</p>
                            <p class="mb-1"><i class="fas fa-phone me-2"></i>+381 11 123 4567</p>
                            <p class="mb-0"><i class="fas fa-envelope me-2"></i>contact@harborshipping.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
      crossorigin=""/>
<style>
    #osm-map {
        border-radius: 0;
        border-top-left-radius: 0.375rem;
        border-top-right-radius: 0.375rem;
    }
    
    .leaflet-marker-icon {
        filter: hue-rotate(200deg) !important;
    }
    
    .leaflet-popup-content {
        font-family: 'Inter', sans-serif;
        font-size: 14px;
    }
    
    .leaflet-control-attribution {
        font-size: 10px;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Belgrade coordinates (Kneza Miloša 20)
        const belgrade = [44.8125, 20.4612];
        
        // Initialize map
        const map = L.map('osm-map').setView(belgrade, 16);
        
        // Add OpenStreetMap tiles
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Custom icon
        const shippingIcon = L.icon({
            iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34]
        });
        
        // Add marker
        L.marker(belgrade, { icon: shippingIcon })
            .addTo(map)
            .bindPopup("<b>Harbor Shipping</b><br>Belgrade Office");
        
        // Optional: Add circle for visual emphasis
        L.circle(belgrade, {
            color: '#0466c8',
            fillColor: '#0466c8',
            fillOpacity: 0.2,
            radius: 100
        }).addTo(map);
    });
</script>
@endpush
@endsection