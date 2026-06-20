@extends('app')

@section('title', 'Add Device — Inventory System')

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
        <h2 class="fw-bold m-0">Add New Device</h2>
        <p class="opacity-75">Daftarkan aset perangkat keras baru ke dalam sistem.</p>
    </div>

    <form action="{{ route('devices.store') }}" method="POST">
        @csrf

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h6 class="text-uppercase text-secondary fw-bold mb-3 small"><i class="bi bi-cpu me-2"></i>Device Identity</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Device Name*</label>
                        <input type="text" class="form-control" name="name" placeholder="Contoh: Switch-Core-01" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Device Role*</label>
                        <select class="form-select" name="device_role_id" required>
                            <option value="" disabled selected>Pilih Role...</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Device Type*</label>
                        <select class="form-select" name="device_type_id" required>
                            <option value="" disabled selected>Pilih Tipe...</option>
                            @foreach($deviceTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->model_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
    <label class="form-label fw-semibold">Platform*</label>
    <select class="form-select" name="platform_id" required>
        <option value="" disabled selected>Pilih Platform...</option>
        @foreach($platforms as $platform)
            <option value="{{ $platform->id }}">{{ $platform->name }}</option>
        @endforeach
    </select>
</div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Site Location*</label>
                        <select class="form-select" name="site_id" required>
                            <option value="" disabled selected>Pilih Site...</option>
                            @foreach($sites as $site)
                                <option value="{{ $site->id }}">{{ $site->name }}</option>
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
                        <input type="text" class="form-control" name="owner_name" placeholder="Nama pemilik">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Department*</label>
                        <select class="form-select" name="department" required>
                            <option value="" disabled selected>Pilih Departemen...</option>
                            <option value="IT">IT</option>
                            <option value="HRD">HRD</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Finance">Finance</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Status*</label>
                        <select class="form-select" name="status" required>
                            <option value="Available">Available</option>
                            <option value="In-Use">In-Use</option>
                            <option value="Maintenance">Maintenance</option>
                            <option value="Broken">Broken</option>
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
    <select class="form-select" name="manufacturer_id" required>
        <option value="" disabled selected>Pilih Manufacturer...</option>
        @foreach($manufacturers as $manufacturer)
            <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
        @endforeach
    </select>
</div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Serial Number</label>
                        <input type="text" class="form-control" name="serial_number" placeholder="SN123456">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Purchase Date</label>
                        <input type="date" class="form-control" name="purchase_date">
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mb-5">
            <a href="{{ route('devices.index') }}" class="btn btn-light px-4 py-2">Cancel</a>
            <button type="submit" class="btn btn-save px-5 py-2 shadow-sm">Save Device</button>
        </div>
    </form>
</div>
@endsection