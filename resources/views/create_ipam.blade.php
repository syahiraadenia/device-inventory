@extends('app')

@section('title', 'Add IP Address — Inventory System')

@section('content')
<div class="container-fluid py-4">
    <div class="gradient-header p-4 mb-4 shadow-sm">
        <h2 class="fw-bold m-0">Add New IP Address</h2>
        <p class="opacity-75 mb-0">Tambahkan data alokasi IP Address baru ke sistem</p>
    </div>

    <div class="card border-0 shadow-sm p-4" style="border-radius: 16px; max-width: 600px;">
        <form action="{{ route('ipam.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Select Device</label> <select name="device_id" class="form-select" required> <option value="">-- Pilih Device --</option>
                    @foreach($devices as $device) <option value="{{ $device->id }}">{{ $device->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">IP Address</label>
                <input type="text" name="ip_address" class="form-control" placeholder="Contoh: 192.168.1.1" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Gateway</label>
                <input type="text" name="gateway" class="form-control" placeholder="Contoh: 192.168.1.254">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Save Data</button>
                <a href="{{ route('ipam.index') }}" class="btn btn-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection