@extends('app')

@section('title', 'Edit Manufacturer — NetBox')

@section('content')
<div class="container-fluid" style="max-width: 850px; margin: 0 auto;">
    <div class="mb-4">
        <a href="{{ route('manufacturers.index') }}" class="text-decoration-none small text-muted">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Manufacturers
        </a>
        <h2 class="fw-bold text-dark mt-2 mb-1">Edit Manufacturer: {{ $manufacturer->name }}</h2>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 8px;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('manufacturers.update', $manufacturer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-transparent pt-3 pb-2 border-0">
                <h5 class="fw-bold text-secondary mb-0" style="font-size: 1.1rem;">Manufacturer</h5>
            </div>
            <div class="card-body pt-1">
                
                <div class="row mb-3 align-items-center">
                    <label for="name" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $manufacturer->name) }}" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <label for="slug" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Slug <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $manufacturer->slug) }}" required>
                    </div>
                </div>

                <div class="row mb-2 align-items-center">
                    <label for="description" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Description</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $manufacturer->description) }}">
                    </div>
                </div>

            </div>
        </div>

        <div class="row mb-5">
            <div class="col-sm-9 offset-sm-3 d-flex gap-2">
                <button type="submit" class="btn btn-success px-4" style="background-color: #007d65; border: none; font-weight: 600;">
                    Save Changes
                </button>
                <a href="{{ route('manufacturers.index') }}" class="btn btn-light border px-4">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection