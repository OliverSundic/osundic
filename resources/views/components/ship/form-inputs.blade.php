<div class="row g-3">
    <!-- Name -->
    <div class="col-md-6">
        <label class="form-label">Ship Name*</label>
        <input type="text" name="name" 
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $ship->name ?? '') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Type -->
    <div class="col-md-6">
        <label class="form-label">Ship Type*</label>
        <select name="type" class="form-select @error('type') is-invalid @enderror" required>
            <option value="">Select Type</option>
            @foreach(['Container Ship', 'Bulk Carrier', 'Tanker', 'LNG Carrier', 'Ro-Ro'] as $type)
            <option value="{{ $type }}" 
                {{ old('type', $ship->type ?? '') == $type ? 'selected' : '' }}>
                {{ $type }}
            </option>
            @endforeach
        </select>
        @error('type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Capacity -->
    <div class="col-md-6">
        <label class="form-label">Capacity (TEU)*</label>
        <input type="number" name="capacity" 
               class="form-control @error('capacity') is-invalid @enderror"
               value="{{ old('capacity', $ship->capacity ?? '') }}" required>
        @error('capacity')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Featured -->
    <div class="col-md-6">
        <div class="form-check form-switch mt-4 pt-2">
            <input class="form-check-input" type="checkbox" name="featured" 
                   id="featured" value="1"
                   {{ old('featured', $ship->featured ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="featured">Featured Ship</label>
        </div>
    </div>

    <!-- Image Upload -->
    <div class="col-12">
        <label class="form-label">Ship Image</label>
        <input type="file" name="image" 
               class="form-control @error('image') is-invalid @enderror"
               accept="image/*">
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @isset($ship->image_path)
            <div class="mt-2">
                <img src="{{ $ship->image_url }}" alt="Current ship image" 
                     class="img-thumbnail" style="max-height: 200px;">
            </div>
        @endisset
    </div>
</div>