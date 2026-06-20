@extends('app')

@section('title', 'Edit Manufacturer — Inventory System')

@section('content')
<div class="container-fluid py-4" style="max-width: 900px;">
    <div class="mb-4">
        <a href="{{ route('manufacturers.index') }}" class="text-decoration-none small text-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Manufacturers
        </a>
        <h2 class="fw-bold text-dark mt-2">Edit Manufacturer: {{ $manufacturer->name }}</h2>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-4 rounded-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('manufacturers.update', $manufacturer->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4 text-primary">Manufacturer Details</h5>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label fw-semibold text-secondary">Name *</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" value="{{ old('name', $manufacturer->name) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label fw-semibold text-secondary">Slug *</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="slug" value="{{ old('slug', $manufacturer->slug) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label fw-semibold text-secondary">Description</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="description" rows="2">{{ old('description', $manufacturer->description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 8px;">Save Changes</button>
            <a href="{{ route('manufacturers.index') }}" class="btn btn-light px-4 py-2" style="border-radius: 8px;">Cancel</a>
        </div>
    </form>
</div>
@endsection