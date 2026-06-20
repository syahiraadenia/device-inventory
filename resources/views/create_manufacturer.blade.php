@extends('app')

@section('title', 'Add Manufacturer — Inventory System')

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
        <h2 class="fw-bold m-0">Add New Manufacturer</h2>
        <p class="opacity-75">Daftarkan brand atau produsen perangkat keras baru.</p>
    </div>

    <form action="{{ route('manufacturers.store') }}" method="POST">
        @csrf

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h6 class="text-uppercase text-secondary fw-bold mb-4 small"><i class="bi bi-buildings me-2"></i>Manufacturer Details</h6>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Name*</label>
                    <input type="text" name="name" class="form-control" required placeholder="Contoh: Cisco, Juniper">
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Slug*</label>
                    <div class="input-group">
                        <input type="text" name="slug" class="form-control" required placeholder="Contoh: cisco">
                        <button class="btn btn-outline-secondary" type="button"><i class="bi bi-arrow-clockwise"></i></button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <input type="text" name="description" class="form-control" placeholder="Keterangan singkat mengenai produsen...">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tags</label>
                    <select name="tags" class="form-select">
                        <option value="">---------</option>
                        <option value="Hardware">Hardware</option>
                        <option value="Virtual">Virtual</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mb-5">
            <a href="{{ route('manufacturers.index') }}" class="btn btn-light px-4 py-2 border">Cancel</a>
            <button type="submit" name="add_another" value="1" class="btn btn-outline-primary px-3 py-2 fw-semibold">Save & Add Another</button>
            <button type="submit" class="btn btn-save px-5 py-2 shadow-sm">Save Manufacturer</button>
        </div>
    </form>
</div>
@endsection