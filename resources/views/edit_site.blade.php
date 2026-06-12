@extends('app')

@section('title', 'Edit Site — NetBox INV')

@section('content')
<div class="container-fluid px-0">
    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1">Edit Site: {{ $site->name }}</h2>
        <p class="text-muted small">Update informasi data center atau lokasi site.</p>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 12px; border: 1px solid #e2e8f0;">
        <div class="card-body p-4">
            <form action="{{ route('sites.update', $site->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Site</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $site->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $site->slug) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="Active" {{ $site->status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Planned" {{ $site->status == 'Planned' ? 'selected' : '' }}>Planned</option>
                            <option value="Offline" {{ $site->status == 'Offline' ? 'selected' : '' }}>Offline</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Facility</label>
                        <input type="text" name="facility" class="form-control" value="{{ old('facility', $site->facility) }}">
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                    <a href="{{ route('sites.index') }}" class="btn btn-light border px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection