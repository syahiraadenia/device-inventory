@extends('app')

@section('title', 'Edit Device Type — NetBox')

@section('content')
<div class="container-fluid" style="max-width: 850px; margin: 0 auto;">
    <div class="mb-4">
        <a href="{{ route('device-types.index') }}" class="text-decoration-none small text-muted">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Device Types
        </a>
        <h2 class="fw-bold text-dark mt-2 mb-1">Edit Device Type: {{ $device_type->model }}</h2>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 8px;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('device-types.update', $device_type->id) }}" method="POST">
        @csrf
        @method('PUT') <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-transparent pt-3 pb-2 border-0">
                <h5 class="fw-bold text-secondary mb-0" style="font-size: 1.1rem;">Device Type</h5>
            </div>
            <div class="card-body pt-1">
                
                <div class="row mb-3 align-items-center">
    <label for="manufacturer_id" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Manufacturer <span class="text-danger">*</span></label>
    <div class="col-sm-9">
        <select class="form-select" id="manufacturer_id" name="manufacturer_id" required>
            <option value="">---------</option>
            {{-- Loop semua manufacturer dari database --}}
            @foreach($manufacturers as $manufacturer)
                <option value="{{ $manufacturer->id }}" 
                    {{ old('manufacturer_id', $device_type->manufacturer_id) == $manufacturer->id ? 'selected' : '' }}>
                    {{ $manufacturer->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

                <div class="row mb-3 align-items-center">
                    <label for="model" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Model <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="model" name="model" value="{{ old('model', $device_type->model) }}" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <label for="slug" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Slug <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $device_type->slug) }}" required>
                        <div class="form-text text-muted" style="font-size: 0.75rem;">URL-friendly unique shorthand</div>
                    </div>
                </div>
                <div class="row mb-3 align-items-center">
                    <label for="default_platform" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Default platform</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="default_platform" name="default_platform">
                            <option value="">---------</option>
                            @foreach($platforms as $platform)
                                <option value="{{ $platform->id }}" 
                                    {{ old('default_platform', $device_type->platform_id) == $platform->id ? 'selected' : '' }}>
                                    {{ $platform->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-2 align-items-start">
                    <label for="description" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Description</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $device_type->description) }}">
                    </div>
                </div>

            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-transparent pt-3 pb-2 border-0">
                <h5 class="fw-bold text-secondary mb-0" style="font-size: 1.1rem;">Chassis</h5>
            </div>
            <div class="card-body pt-1">
                
                <div class="row mb-2 align-items-center">
                    <label for="height" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Height (U) <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="number" step="0.5" class="form-control" id="height" name="height" value="{{ old('height', $device_type->height) }}" required>
                    </div>
                </div>

            </div>
        </div>

        <div class="row mb-5">
            <div class="col-sm-9 offset-sm-3 d-flex gap-2">
                <button type="submit" class="btn btn-success px-4" style="background-color: #007d65; border: none; font-weight: 600;">
                    Save Changes
                </button>
                <a href="{{ route('device-types.index') }}" class="btn btn-light border px-4">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection