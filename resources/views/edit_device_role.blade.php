@extends('app')

@section('title', 'Edit Device Role — NetBox')

@section('content')
<div class="container-fluid" style="max-width: 850px; margin: 0 auto;">
    <div class="mb-4">
        <a href="{{ route('device-roles.index') }}" class="text-decoration-none small text-muted">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Device Roles
        </a>
        <h2 class="fw-bold text-dark mt-2 mb-1">Edit Device Role: {{ $role->name }}</h2>
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

    <form action="{{ route('device-roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-transparent pt-3 pb-2 border-0">
                <h5 class="fw-bold text-secondary mb-0" style="font-size: 1.1rem;">Device Role</h5>
            </div>
            <div class="card-body pt-1">
                
                <div class="row mb-3 align-items-center">
                    <label for="name" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name) }}" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <label for="slug" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Slug <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $role->slug) }}" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <label for="color" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Color <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select" id="color" name="color" required>
                            <option value="Red" {{ old('color', $role->color) == 'Red' ? 'selected' : '' }}>Red</option>
                            <option value="Blue" {{ old('color', $role->color) == 'Blue' ? 'selected' : '' }}>Blue</option>
                            <option value="Green" {{ old('color', $role->color) == 'Green' ? 'selected' : '' }}>Green</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-2 align-items-center">
                    <label for="description" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Description</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $role->description) }}">
                    </div>
                </div>

            </div>
        </div>

        <div class="row mb-5">
            <div class="col-sm-9 offset-sm-3 d-flex gap-2">
                <button type="submit" class="btn btn-success px-4" style="background-color: #007d65; border: none; font-weight: 600;">
                    Save Changes
                </button>
                <a href="{{ route('device-roles.index') }}" class="btn btn-light border px-4">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection