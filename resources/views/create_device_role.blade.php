@extends('app')

@section('title', 'Add a New Device Role — NetBox')

@section('content')
<div class="container-fluid" style="max-width: 850px; margin: 0 auto;">
    <div class="mb-4">
        <a href="{{ route('device-roles.index') }}" class="text-decoration-none small text-muted">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Device Roles
        </a>
        <h2 class="fw-bold text-dark mt-2 mb-1">Add a New Role</h2>
    </div>

    <form action="{{ route('device-roles.store') }}" method="POST">
        @csrf

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-transparent pt-3 pb-2 border-0">
                <h5 class="fw-bold text-secondary mb-0" style="font-size: 1.1rem;">Role Details</h5>
            </div>
            <div class="card-body pt-1">
                
                {{-- Nama Role/Kategori Aset --}}
                <div class="row mb-3 align-items-center">
                    <label for="name" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Role Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Contoh: IT Support, HRD" required>
                    </div>
                </div>

                {{-- Departemen (Menggantikan Color) --}}
                <div class="row mb-3 align-items-center">
                    <label for="department" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Department <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select" id="department" name="department" required>
                            <option value="">Pilih Departemen...</option>
                            <option value="IT">IT</option>
                            <option value="HRD">HRD</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Finance">Finance</option>
                            <option value="Operations">Operations</option>
                        </select>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="row mb-2 align-items-start">
                    <label for="description" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Description</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="description" name="description" rows="2" placeholder="Tujuan atau fungsi perangkat untuk departemen ini"></textarea>
                    </div>
                </div>

            </div>
        </div>

        <div class="row mb-5">
            <div class="col-sm-9 offset-sm-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Create Role</button>
                <a href="{{ route('device-roles.index') }}" class="btn btn-light border px-4">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection