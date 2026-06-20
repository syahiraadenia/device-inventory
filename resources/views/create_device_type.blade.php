@extends('app')

@section('title', 'Add Device Type — Inventory System')

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
        <h2 class="fw-bold m-0">Add New Device Type</h2>
        <p class="opacity-75">Definisikan model fisik dan spesifikasi sasis perangkat baru.</p>
    </div>

    <form action="{{ route('device-types.store') }}" method="POST">
        @csrf

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h6 class="text-uppercase text-secondary fw-bold mb-4 small"><i class="bi bi-cpu me-2"></i>Device Type Details</h6>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Manufacturer*</label>
                    <div class="input-group">
                        <select class="form-select" name="manufacturer_id" required>
                            <option value="" selected>Pilih Manufacturer...</option>
                            @foreach($manufacturers as $manufacturer)
                                <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                            @endforeach
                        </select>
                        <a href="{{ route('manufacturers.index') }}" class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i></a>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Model Name*</label>
                    <input type="text" name="model" class="form-control" required placeholder="Contoh: Catalyst 9300">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Slug*</label>
                    <div class="input-group">
                        <input type="text" name="slug" class="form-control" required placeholder="Contoh: cat-9300">
                        <button class="btn btn-outline-secondary" type="button"><i class="bi bi-arrow-clockwise"></i></button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Default Platform</label>
                    <select class="form-select" name="default_platform">
                        <option value="">---------</option>
                        @foreach($platforms as $platform)
                            <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <input type="text" name="description" class="form-control">
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h6 class="text-uppercase text-secondary fw-bold mb-4 small"><i class="bi bi-layers me-2"></i>Chassis Specifications</h6>
                
                <div class="mb-0">
                    <label class="form-label fw-semibold">Height (U)*</label>
                    <input type="number" step="0.5" name="height" class="form-control" value="1.0" required>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mb-5">
            <a href="{{ route('device-types.index') }}" class="btn btn-light px-4 py-2 border">Cancel</a>
            <button type="submit" name="add_another" value="1" class="btn btn-outline-primary px-3 py-2 fw-semibold">Save & Add Another</button>
            <button type="submit" class="btn btn-save px-5 py-2 shadow-sm">Save Device Type</button>
        </div>
    </form>
</div>
@endsection