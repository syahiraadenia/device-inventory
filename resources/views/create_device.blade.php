@extends('app')

@section('title', 'Add a New Device — NetBox')

@section('content')
<div class="container-fluid" style="max-width: 900px; margin: 0 auto;">
    <div class="mb-4">
        <a href="{{ route('devices.index') }}" class="text-decoration-none small text-muted">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Devices
        </a>
        <h2 class="fw-bold text-dark mt-2 mb-1">Add a New Device</h2>
    </div>

    <form action="{{ route('devices.store') }}" method="POST">
        @csrf

        {{-- BAGIAN IDENTITAS --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-transparent pt-3 pb-2 border-0">
                <h5 class="fw-bold text-secondary mb-0">Device Details</h5>
            </div>
            <div class="card-body pt-1">
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Device Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" placeholder="Contoh: Laptop-Budi-01" required>
                    </div>
                </div>
               <div class="row mb-3 align-items-center">
    <label class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Role</label>
    <div class="col-sm-9">
        <select class="form-select" name="device_role_id" required>
            <option value="" disabled selected>Pilih Role...</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
</div>

        {{-- BAGIAN KEPEMILIKAN (OWNERSHIP) --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-transparent pt-3 pb-2 border-0">
                <h5 class="fw-bold text-secondary mb-0">Ownership</h5>
            </div>
            <div class="card-body pt-1">
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Owner Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="owner_name" placeholder="Nama pemilik perangkat">
                    </div>
                </div>
                <div class="row mb-3 align-items-center">
    <label class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Department</label>
    <div class="col-sm-9">
        <select class="form-select" name="department" required>
            <option value="" disabled selected>Pilih Departemen...</option>
            <option value="IT">IT</option>
            <option value="HRD">HRD</option>
            <option value="Marketing">Marketing</option>
            <option value="Finance">Finance</option>
            <option value="Operations">Operations</option>
        </select>
    </div>
</div>
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Status</label>
                    <div class="col-sm-9">
                        <select class="form-select" name="status" required>
                            <option value="Available">Tersedia</option>
                            <option value="In-Use">Dipakai</option>
                            <option value="Maintenance">Maintenance</option>
                            <option value="Broken">Rusak</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-3 align-items-center">
    <label class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Device Type</label>
    <div class="col-sm-9">
        <select class="form-select" name="device_type_id" required>
            <option value="" disabled selected>Pilih Tipe Perangkat...</option>
            @foreach($deviceTypes as $type)
                <option value="{{ $type->id }}">{{ $type->model_name }}</option>
            @endforeach
        </select>
    </div>
</div>

        <div class="row mb-3 align-items-center">
    <label class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Site</label>
    <div class="col-sm-9">
        <select class="form-select" name="site_id" required>
            <option value="" disabled selected>Pilih Site...</option>
            @foreach($sites as $site)
                <option value="{{ $site->id }}">{{ $site->name }}</option>
            @endforeach
        </select>
    </div>
</div>

        {{-- BAGIAN HARDWARE --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-transparent pt-3 pb-2 border-0">
                <h5 class="fw-bold text-secondary mb-0">Hardware Info</h5>
            </div>
            <div class="card-body pt-1">
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Manufacturer</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="manufacturer" placeholder="Contoh: Lenovo, Dell">
                    </div>
                </div>
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Serial Number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="serial_number">
                    </div>
                </div>
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Purchase Date</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" name="purchase_date">
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-sm-9 offset-sm-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Create Device</button>
                <a href="{{ route('devices.index') }}" class="btn btn-light border px-4">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection