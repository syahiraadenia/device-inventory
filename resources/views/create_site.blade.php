@extends('app')

@section('title', 'Add Site — Inventory System')

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
        <h2 class="fw-bold m-0">Add New Site</h2>
        <p class="opacity-75">Tambahkan lokasi fisik atau data center baru ke dalam sistem.</p>
    </div>

    <form action="{{ route('sites.store') }}" method="POST">
        @csrf

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h6 class="text-uppercase text-secondary fw-bold mb-4 small"><i class="bi bi-buildings me-2"></i>Site Details</h6>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Site Name*</label>
                    <input type="text" name="name" class="form-control" required placeholder="Contoh: Jakarta Data Center">
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Slug*</label>
                    <input type="text" name="slug" class="form-control" required placeholder="Contoh: jkt-dc-01">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status*</label>
                    <select name="status" class="form-select">
                        <option value="active">Active</option>
                        <option value="planned">Planned</option>
                        <option value="retired">Retired</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <input type="text" name="description" class="form-control" placeholder="Opsional...">
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mb-5">
            <a href="{{ route('sites.index') }}" class="btn btn-light px-4 py-2 border">Cancel</a>
            <button type="submit" class="btn btn-save px-5 py-2 shadow-sm">Save Site</button>
        </div>
    </form>
</div>
@endsection