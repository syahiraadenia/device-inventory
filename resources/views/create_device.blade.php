@extends('app')

@section('title', 'Add a New Device — NetBox')

@section('content')
<div class="container-fluid" style="max-width: 900px; margin: 0 auto;">
    <div class="mb-4">
        <a href="{{ route('devices.index') }}" class="text-decoration-none small text-muted">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Devices
        </a>
        <h2 class="fw-bold text-dark mt-2 mb-1">Add a New Device</h2>
        <p class="text-muted small">Silakan lengkapi spesifikasi perangkat infrastruktur baru Anda.</p>
    </div>

    <form action="{{ route('devices.store') }}" method="POST">
        @csrf

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-transparent pt-3 pb-2 border-0">
                <h5 class="fw-bold text-secondary mb-0" style="font-size: 1.1rem;">Device</h5>
            </div>
            <div class="card-body pt-1">
                <div class="row mb-3 align-items-center">
                    <label for="name" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Contoh: id-sub-sw01" required>
                    </div>
                </div>
                <div class="row mb-3 align-items-center">
    <label for="role" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">
        Device Role <span class="text-danger">*</span>
    </label>
    
    <div class="col-sm-9">
        <div class="input-group">
            <select class="form-select" id="role" name="role" required>
                <option value="" selected>---------</option>
                
                {{-- Cek apakah $roles ada dan tidak kosong --}}
                @if(isset($roles) && count($roles) > 0)
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                @else
                    <option value="" disabled>Data role belum tersedia</option>
                @endif
            </select>
            
            <a href="{{ route('device-roles.index') }}" class="btn btn-outline-secondary" title="Tambah Role Baru">
                <i class="bi bi-plus-lg"></i>
            </a>
        </div>
    </div>
</div>
                <div class="row mb-3 align-items-start">
                    <label for="description" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Description</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <label for="tags" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Tags</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="tags" name="tags">
                            <option value="" selected>---------</option>
                            <option value="Production">Production</option>
                            <option value="Staging">Staging</option>
                            <option value="Lab">Lab</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-transparent pt-3 pb-2 border-0">
                <h5 class="fw-bold text-secondary mb-0" style="font-size: 1.1rem;">Hardware</h5>
            </div>
            <div class="card-body pt-1">
                <div class="row mb-3 align-items-center">
    <label for="device_type_id" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Device type <span class="text-danger">*</span></label>
    <div class="col-sm-9">
        <div class="input-group">
            <select class="form-select" id="device_type_id" name="device_type_id" required>
                <option value="">---------</option>
                @foreach($deviceTypes as $dt)
                    <option value="{{ $dt->id }}">
                        {{ $dt->model_name }}
                    </option>
                @endforeach
            </select>
            <a href="{{ route('device-types.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-search"></i>
            </a>
        </div>
    </div>
</div>
                <div class="row mb-3 align-items-center">
                    <label for="airflow" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Airflow</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="airflow" name="airflow">
                            <option value="" selected>---------</option>
                            <option value="Front to Back">Front to Back</option>
                            <option value="Back to Front">Back to Front</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="serial_number" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted mb-0">Serial number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="serial_number" name="serial_number">
                        <div class="form-text text-muted" style="font-size: 0.75rem;">Chassis serial number, assigned by the manufacturer.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-transparent pt-3 pb-2 border-0">
                <h5 class="fw-bold text-secondary mb-0" style="font-size: 1.1rem;">Location</h5>
            </div>
            <div class="card-body pt-1">
                <div class="row mb-3 align-items-center">
                    <label for="site" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Site <span class="text-danger">*</span></label>
                    <div class="row mb-3 align-items-center">
    <label for="site_id" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Site <span class="text-danger">*</span></label>
    <div class="col-sm-9">
        <div class="input-group">
            <select class="form-select" id="site_id" name="site_id" required>
                <option value="">---------</option>
                
                {{-- Mengambil data dari variabel $sites yang dikirim oleh Controller --}}
                @foreach($sites as $site)
                    <option value="{{ $site->id }}">{{ $site->name }}</option>
                @endforeach
            </select>
            <a href="{{ route('sites.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-search"></i>
            </a>
        </div>
    </div>
</div>
                <div class="row mb-3 align-items-center">
                    <label for="location" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Location</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="location" name="location">
                            <option value="" selected>---------</option>
                            <option value="Lantai 1">Lantai 1</option>
                            <option value="Lantai 2">Lantai 2</option>
                            <option value="Server Room">Server Room</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 align-items-center">
                    <label for="rack" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Rack</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="rack" name="rack">
                            <option value="" selected>---------</option>
                            <option value="Rack-01">Rack-01</option>
                            <option value="Rack-02">Rack-02</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 align-items-center">
                    <label for="face" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Face</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="face" name="face">
                            <option value="" selected>---------</option>
                            <option value="Front">Front</option>
                            <option value="Rear">Rear</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="position" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted mb-0">Position</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="position" name="position">
                            <option value="" selected>---------</option>
                            @for ($i = 1; $i <= 42; $i++)
                                <option value="{{ $i }}">U{{ $i }}</option>
                            @endfor
                        </select>
                        <div class="form-text text-muted" style="font-size: 0.75rem;">The lowest-numbered unit occupied by the device.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-transparent pt-3 pb-2 border-0">
                <h5 class="fw-bold text-secondary mb-0" style="font-size: 1.1rem;">Management</h5>
            </div>
            <div class="card-body pt-1">
                <div class="row mb-3 align-items-center">
                    <label for="status" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Status <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select" id="status" name="status" required>
                            <option value="Active" selected>Active</option>
                            <option value="Offline">Offline</option>
                            <option value="Planned">Planned</option>
                            <option value="Staged">Staged</option>
                            <option value="Failed">Failed</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 align-items-center">
                    <label for="platform" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Platform</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <select class="form-select" id="platform" name="platform">
                                <option value="" selected>---------</option>
                                <option value="Cisco IOS-XE">Cisco IOS-XE</option>
                                <option value="Linux">Linux</option>
                            </select>
                            <a href="{{ route('platforms.index') }}" class="btn btn-outline-secondary"><i class="bi bi-search"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <label for="ip_address" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">IP Address</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="ip_address" name="ip_address" placeholder="Contoh: 192.168.10.5">
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-transparent pt-3 pb-2 border-0">
                <h5 class="fw-bold text-secondary mb-0" style="font-size: 1.1rem;">Tenancy</h5>
            </div>
            <div class="card-body pt-1">
                <div class="row mb-3 align-items-center">
                    <label for="tenant_group" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Tenant group</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="tenant_group" name="tenant_group">
                            <option value="" selected>---------</option>
                            <option value="Internal">Internal</option>
                            <option value="Customer">Customer</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2 align-items-center">
                    <label for="tenant" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Tenant</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <select class="form-select" id="tenant" name="tenant">
                                <option value="" selected>---------</option>
                                <option value="Internal IT">Internal IT</option>
                                <option value="Finance Dept">Finance Dept</option>
                            </select>
                            <button type="button" class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-sm-9 offset-sm-3 d-flex gap-2">
                <button type="submit" class="btn btn-success px-4" style="background-color: #007d65; border: none; font-weight: 600;">
                    Create
                </button>
                <button type="submit" name="add_another" value="1" class="btn btn-outline-success px-3" style="color: #007d65; border-color: #007d65; font-weight: 500;">
                    Create & Add Another
                </button>
                <a href="{{ route('devices.index') }}" class="btn btn-light border px-4">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection