@extends('app')

@section('title', 'Edit Site — Inventory System')

@section('content')
<div class="container-fluid py-4" style="max-width: 900px; font-size: 0.9rem;">
    <div class="mb-4">
        <a href="{{ route('sites.index') }}" class="text-decoration-none small text-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Sites
        </a>
        <h2 class="fw-bold text-dark mt-2">Edit Site: {{ $site->name }}</h2>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-4 rounded-3 small">
            <ul class="mb-0">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sites.update', $site->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-4 text-primary text-uppercase" style="letter-spacing: 0.5px;">
                    <i class="bi bi-geo-alt me-2"></i>Site Information
                </h6>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary small">Site Name *</label>
                        <input type="text" name="name" class="form-control border-light" value="{{ old('name', $site->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary small">Slug *</label>
                        <input type="text" name="slug" class="form-control border-light" value="{{ old('slug', $site->slug) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary small">Status *</label>
                        <select name="status" class="form-select border-light" required>
                            <option value="active" {{ old('status', $site->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="planned" {{ old('status', $site->status) == 'planned' ? 'selected' : '' }}>Planned</option>
                            <option value="offline" {{ old('status', $site->status) == 'offline' ? 'selected' : '' }}>Offline</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary small">Description</label>
                        <input type="text" name="description" class="form-control border-light" value="{{ old('description', $site->description) }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm" style="border-radius: 8px;">
                <i class="bi bi-check-lg me-1"></i> Save Changes
            </button>
            <a href="{{ route('sites.index') }}" class="btn btn-light px-4 py-2 border shadow-sm" style="border-radius: 8px;">Cancel</a>
        </div>
    </form>
</div>
@endsection