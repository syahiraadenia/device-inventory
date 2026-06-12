@extends('app')

@section('title', 'Edit Perangkat — NetBox')

@section('content')
<div class="container-fluid" style="max-width: 850px; margin: 0 auto;">
    <div class="mb-4">
        <a href="{{ route('devices.index') }}" class="text-decoration-none small text-muted">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Devices
        </a>
        <h2 class="fw-bold text-dark mt-2 mb-1">Edit Perangkat: {{ $device->name }}</h2>
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

    <form action="{{ route('devices.update', $device->id) }}" method="POST">
        @csrf
        @method('PUT') <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-transparent pt-3 pb-2 border-0">
                <h5 class="fw-bold text-secondary mb-0" style="font-size: 1.1rem;">Hardware & Identitas</h5>
            </div>
            <div class="card-body pt-1">
                
                <div class="row mb-3 align-items-center">
                    <label for="name" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $device->name) }}" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <label for="status" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Status <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select" id="status" name="status" required>
                            <option value="Active" {{ old('status', $device->status) == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Offline" {{ old('status', $device->status) == 'Offline' ? 'selected' : '' }}>Offline</option>
                            <option value="Planned" {{ old('status', $device->status) == 'Planned' ? 'selected' : '' }}>Planned</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <label for="tenant" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Tenant</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tenant" name="tenant" value="{{ old('tenant', $device->tenant) }}">
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <label for="site" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Site <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="site" name="site" value="{{ old('site', $device->site) }}" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <label for="location" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Location</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $device->location) }}">
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <label for="rack" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Rack</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="rack" name="rack" value="{{ old('rack', $device->rack) }}">
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <label for="role" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Role <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="role" name="role" value="{{ old('role', $device->role) }}" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <label for="manufacturer" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Manufacturer <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="manufacturer" name="manufacturer" value="{{ old('manufacturer', $device->manufacturer) }}" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <label for="device_type" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Device Type <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="device_type" name="device_type" value="{{ old('device_type', $device->type) }}" required>
                    </div>
                </div>

                <div class="row mb-2 align-items-center">
                    <label for="ip_address" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">IP Address</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control font-monospace" id="ip_address" name="ip_address" value="{{ old('ip_address', $device->ip_address) }}" placeholder="e.g. 192.168.1.1">
                    </div>
                </div>

            </div>
        </div>

        <div class="row mb-5">
            <div class="col-sm-9 offset-sm-3 d-flex gap-2">
                <button type="submit" class="btn btn-success px-4" style="background-color: #007d65; border: none; font-weight: 600;">
                    Save Changes
                </button>
                <a href="{{ route('devices.index') }}" class="btn btn-light border px-4">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection