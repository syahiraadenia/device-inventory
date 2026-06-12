@extends('app')

@section('content')
<div class="container-fluid py-4">
    <h2 class="mb-4">Add a new site</h2>
    <div class="card p-4 shadow-sm" style="max-width: 600px;">
        <form action="{{ route('sites.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name*</label>
                <input type="text" name="name" class="form-control" required placeholder="Full name of the site">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Slug*</label>
                <input type="text" name="slug" class="form-control" required placeholder="URL-friendly unique shorthand">
            </div>

            <div class="mb-3">
                <label class="form-label">Status*</label>
                <select name="status" class="form-select">
                    <option value="active">Active</option>
                    <option value="planned">Planned</option>
                    <option value="retired">Retired</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Facility</label>
                <input type="text" name="facility" class="form-control" placeholder="Local facility ID or description">
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('sites.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection