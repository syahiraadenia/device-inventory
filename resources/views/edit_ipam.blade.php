@extends('app')

@section('title', 'Edit IP Address — Inventory System')

@section('content')
<div class="container-fluid py-4">
    <div class="gradient-header p-4 mb-4 shadow-sm">
        <h2 class="fw-bold m-0">Edit IP Address</h2>
        <p class="opacity-75 mb-0">Perbarui informasi alokasi IP Address</p>
    </div>

    <div class="card border-0 shadow-sm p-4" style="border-radius: 16px; max-width: 600px;">
        <form action="{{ route('ipam.update', $ipam->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold">Select Device</label>
                <select name="device_id" class="form-select" required>
                    @foreach($devices as $device)
                        <option value="{{ $device->id }}" {{ $ipam->device_id == $device->id ? 'selected' : '' }}>
                            {{ $device->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">IP Address</label>
                <input type="text" name="ip_address" class="form-control" value="{{ $ipam->ip_address }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Gateway</label>
                <input type="text" name="gateway" class="form-control" value="{{ $ipam->gateway }}">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Update Data</button>
                <a href="{{ route('ipam.index') }}" class="btn btn-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection