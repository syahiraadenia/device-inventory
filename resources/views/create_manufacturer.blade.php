@extends('app')

@section('title', 'Add a New Manufacturer — NetBox')

@section('content')
<div class="container-fluid" style="max-width: 850px; margin: 0 auto;">
    <div class="mb-4">
        <a href="{{ route('manufacturers.index') }}" class="text-decoration-none small text-muted">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Manufacturers
        </a>
        <h2 class="fw-bold text-dark mt-2 mb-1">Add a New Manufacturer</h2>
    </div>

    <form action="{{ route('manufacturers.store') }}" method="POST">
        @csrf

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-transparent pt-3 pb-2 border-0">
                <h5 class="fw-bold text-secondary mb-0" style="font-size: 1.1rem;">Manufacturer</h5>
            </div>
            <div class="card-body pt-1">
                
                <div class="row mb-3 align-items-center">
                    <label for="name" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <label for="slug" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Slug <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control" id="slug" name="slug" required>
                            <button class="btn btn-outline-secondary" type="button" title="Regenerate Slug">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </div>
                        <div class="form-text text-muted" style="font-size: 0.75rem;">URL-friendly unique shorthand</div>
                    </div>
                </div>

                <div class="row mb-3 align-items-start">
                    <label for="description" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Description</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                </div>

                <div class="row mb-2 align-items-center">
                    <label for="tags" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Tags</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="tags" name="tags">
                            <option value="" selected>---------</option>
                            <option value="Hardware">Hardware</option>
                            <option value="Virtual">Virtual</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-header bg-transparent pt-3 pb-2 border-0">
                <h5 class="fw-bold text-secondary mb-0" style="font-size: 1.1rem;">Ownership</h5>
            </div>
            <div class="card-body pt-1">
                
                <div class="row mb-3 align-items-center">
                    <label for="owner_group" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Owner group</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="owner_group" name="owner_group">
                            <option value="" selected>---------</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-2 align-items-center">
                    <label for="owner" class="col-sm-3 col-form-label text-sm-end fw-semibold text-muted">Owner</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="owner" name="owner">
                            <option value="" selected>---------</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>

        <div class="row mb-5">
            <div class="col-sm-9 offset-sm-3 d-flex gap-2">
                <button type="submit" class="btn btn-success px-4" style="background-color: #007d65; border: none; font-weight: 600;">
                    Create
                </button>
                <button type="submit" name="add_another" value="1" class="btn btn-outline-success px-3" style="color: #007d65; border-color: #007d65; font-weight: 500;">
                    Create & Add Another
                </button>
                <a href="{{ route('manufacturers.index') }}" class="btn btn-light border px-4">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection