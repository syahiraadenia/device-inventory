@extends('app')

@section('title', 'Edit Device — Inventory System')

@section('content')
<style>
    .gradient-header { background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%); color: white; border-radius: 12px; }
    .card { border-radius: 16px !important; transition: transform 0.2s; }
    .form-control, .form-select { border: 1px solid #e2e8f0; padding: 0.65rem 1rem; border-radius: 8px; }
    .form-control:focus, .form-select:focus { border-color: #2a5298; box-shadow: 0 0 0 3px rgba(42, 82, 152, 0.1); }
    .btn-save { background: linear-gradient(45deg, #2a5298, #1e3c72); border: none; color: white; }
</style>

<div class="container-fluid py-4" style="max-width: 900px;">
    <div class="gradient-header p-4 mb-4 shadow-sm">
        <h2 class="fw-bold m-0">Edit Device: {{ $device->name }}</h2>
        <p class="opacity-75">Perbarui informasi aset perangkat keras.</p>
    </div>

    <form action="{{ route('devices.update', $device->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h6 class="text-uppercase text-secondary fw-bold mb-3 small"><i class="bi bi-cpu me-2"></i>Device Identity</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Device Name*</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $device->name) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Device Role*</label>
                        <select class="form-select" name="device_role_id" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" @selected(old('device_role_id', $device->device_role_id) == $role->id)>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Device Type*</label>
                        <select class="form-select" name="device_type_id" required>
                            @foreach($deviceTypes as $type)
                                <option value="{{ $type->id }}" @selected(old('device_type_id', $device->device_type_id) == $type->id)>{{ $type->model_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
    <label class="form-label fw-semibold">Platform*</label>
    <select class="form-select" name="platform_id" required>
        <option value="" disabled>Pilih Platform...</option>
        @foreach($platforms as $platform)
            <option value="{{ $platform->id }}" @selected(old('platform_id', $device->platform_id) == $platform->id)>
                {{ $platform->name }}
            </option>
        @endforeach
    </select>
</div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Site Location*</label>
                        <select class="form-select" name="site_id" required>
                            @foreach($sites as $site)
                                <option value="{{ $site->id }}" @selected(old('site_id', $device->site_id) == $site->id)>{{ $site->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h6 class="text-uppercase text-secondary fw-bold mb-3 small"><i class="bi bi-person-badge me-2"></i>Ownership & Status</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Owner Name</label>
                        <input type="text" class="form-control" name="owner_name" value="{{ old('owner_name', $device->owner_name) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Department*</label>
                        <select class="form-select" name="department" required>
                            @foreach(['IT', 'HRD', 'Marketing', 'Finance'] as $dept)
                                <option value="{{ $dept }}" @selected(old('department', $device->department) == $dept)>{{ $dept }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Status*</label>
                        <select class="form-select" name="status" required>
                            @foreach(['Available', 'In-Use', 'Maintenance', 'Broken'] as $stat)
                                <option value="{{ $stat }}" @selected(old('status', $device->status) == $stat)>{{ $stat }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <h6 class="text-uppercase text-secondary fw-bold mb-3 small"><i class="bi bi-tools me-2"></i>Hardware Info</h6>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Manufacturer*</label>
                <select class="form-select" name="manufacturer" required>
                    <option value="" disabled>Pilih Manufacturer...</option>
                    @foreach($manufacturers as $manufacturer)
                        <option value="{{ $manufacturer->name }}" 
                            @selected(old('manufacturer_id', $device->manufacturer_id) == $manufacturer->id)>
                            {{ $manufacturer->name }}
                        </option>
                    @endforeach
                </select>
            </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Serial Number</label>
                        <input type="text" class="form-control" name="serial_number" value="{{ old('serial_number', $device->serial_number) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Purchase Date</label>
                        <input type="date" class="form-control" name="purchase_date" value="{{ old('purchase_date', $device->purchase_date) }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mb-5">
            <a href="{{ route('devices.index') }}" class="btn btn-light px-4 py-2">Cancel</a>
            <button type="submit" class="btn btn-save px-5 py-2 shadow-sm">Update Device</button>
        </div>
    </form>
</div>
@endsection