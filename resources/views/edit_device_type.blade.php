@extends('app')

@section('title', 'Edit Device Type — Inventory System')

@section('content')
<div class="container-fluid py-4" style="max-width: 900px;">
    <div class="mb-4">
        <a href="{{ route('device-types.index') }}" class="text-decoration-none small text-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Device Types
        </a>
        <h2 class="fw-bold text-dark mt-2">Edit: {{ $device_type->model_name }}</h2>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-4 rounded-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('device-types.update', $device_type->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4 text-primary">Device Details</h5>
                
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label fw-semibold text-secondary">Manufacturer *</label>
                    <div class="col-sm-9">
                        <select class="form-select" name="manufacturer_id" required>
                            @foreach($manufacturers as $manufacturer)
                                <option value="{{ $manufacturer->id }}" 
                                    {{ old('manufacturer_id', $device_type->manufacturer_id) == $manufacturer->id ? 'selected' : '' }}>
                                    {{ $manufacturer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label fw-semibold text-secondary">Model Name *</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="model" value="{{ old('model', $device_type->model_name) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label fw-semibold text-secondary">Slug *</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="slug" value="{{ old('slug', $device_type->slug) }}" required>
                        <small class="text-muted">Unique identifier for the device model.</small>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label fw-semibold text-secondary">Default Platform</label>
                    <div class="col-sm-9">
                        <select class="form-select" name="default_platform">
                            <option value="">Select Platform...</option>
                            @foreach($platforms as $platform)
                                <option value="{{ $platform->id }}" 
                                    {{ old('default_platform', $device_type->platform_id) == $platform->id ? 'selected' : '' }}>
                                    {{ $platform->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label fw-semibold text-secondary">Description</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="description" rows="2">{{ old('description', $device_type->description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4 text-primary">Chassis Specifications</h5>
                <div class="row mb-0">
                    <label class="col-sm-3 col-form-label fw-semibold text-secondary">Height (U) *</label>
                    <div class="col-sm-9">
                        <input type="number" step="0.5" class="form-control" name="height" value="{{ old('height', $device_type->height) }}" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 8px;">Save Changes</button>
            <a href="{{ route('device-types.index') }}" class="btn btn-light px-4 py-2" style="border-radius: 8px;">Cancel</a>
        </div>
    </form>
</div>
@endsection