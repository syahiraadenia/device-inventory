@extends('app')

@section('title', 'Add Device Role — Inventory System')

@section('content')
<style>
    .gradient-header { background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%); color: white; border-radius: 12px; }
    .card { border-radius: 16px !important; }
    .form-control, .form-select { border: 1px solid #e2e8f0; padding: 0.65rem 1rem; border-radius: 8px; }
    .form-control:focus, .form-select:focus { border-color: #2a5298; box-shadow: 0 0 0 3px rgba(42, 82, 152, 0.1); }
    .btn-save { background: linear-gradient(45deg, #2a5298, #1e3c72); border: none; color: white; }
</style>

<div class="container-fluid py-4" style="max-width: 800px;">
    <div class="gradient-header p-4 mb-4 shadow-sm">
        <h2 class="fw-bold m-0">Add New Role</h2>
        <p class="opacity-75">Buat klasifikasi peran perangkat baru untuk organisasi.</p>
    </div>

    <form action="{{ route('device-roles.store') }}" method="POST">
        @csrf

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h6 class="text-uppercase text-secondary fw-bold mb-4 small"><i class="bi bi-tag me-2"></i>Role Details</h6>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Role Name*</label>
                    <input type="text" class="form-control" name="name" placeholder="Contoh: IT Support" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Department*</label>
                    <select class="form-select" name="department" required>
                        <option value="" disabled selected>Pilih Departemen...</option>
                        <option value="IT">IT</option>
                        <option value="HRD">HRD</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Finance">Finance</option>
                        <option value="Operations">Operations</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea class="form-control" name="description" rows="3" placeholder="Fungsi atau tujuan role ini..."></textarea>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mb-5">
            <a href="{{ route('device-roles.index') }}" class="btn btn-light px-4 py-2 border">Cancel</a>
            <button type="submit" class="btn btn-save px-5 py-2 shadow-sm">Save Role</button>
        </div>
    </form>
</div>
@endsection