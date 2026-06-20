@extends('app')

@section('title', 'Device Types — Inventory System')

@section('content')
<style>
    .gradient-header { background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%); color: white; border-radius: 12px; }
    .table-hover tbody tr:hover { background-color: #f0f7ff !important; border-left: 4px solid #2a5298; }
    .stat-badge { background: #e2e8f0; color: #475569; font-weight: 700; border-radius: 12px; padding: 2px 10px; font-size: 0.8rem; }
</style>

<div class="container-fluid py-4">
    <div class="gradient-header p-4 mb-4 shadow-sm d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold m-0">Device Types</h2>
            <p class="opacity-75 mb-0">Model-model fisik perangkat beserta spesifikasi sasisnya</p>
        </div>
        <a href="{{ route('device-types.create') }}" class="btn btn-light text-primary fw-bold shadow-sm px-4 py-2" style="border-radius: 8px;">
            <i class="bi bi-plus-lg me-1"></i> Add Device Type
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <form action="{{ route('device-types.index') }}" method="GET">
                <div class="input-group shadow-sm">
                    <input type="text" name="search" class="form-control border-0" placeholder="Cari model..." value="{{ request('search') }}">
                    <button class="btn btn-white bg-white border-0 text-secondary" type="submit"><i class="bi bi-search"></i></button>
                    @if(request('search'))
                        <a href="{{ route('device-types.index') }}" class="btn btn-white bg-white border-0 text-danger"><i class="bi bi-x-lg"></i></a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead style="background: #f8fafc;">
                    <tr class="text-uppercase small text-secondary">
                        <th class="ps-4 py-3">Model Name</th>
                        <th>Manufacturer</th>
                        <th>Part Number</th>
                        <th>Height (U)</th>
                        <th>Device Count</th>
                        <th class="text-center pe-4">Action</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.9rem;">
                    @forelse($device_types as $type)
                        <tr class="table-hover">
                            <td class="ps-4 py-3 fw-bold text-dark">{{ $type->model_name }}</td>
                            <td>{{ $type->manufacturer->name ?? '-' }}</td>
                            <td><code class="text-primary">{{ $type->slug }}</code></td>
                            <td><span class="badge bg-light text-dark border">{{ $type->height }} U</span></td>
                            <td><span class="stat-badge">{{ $type->devices_count }}</span></td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('device-types.edit', $type->id) }}" class="btn btn-sm btn-outline-primary border-0"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('device-types.destroy', $type->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-cpu d-block display-4 mb-2 opacity-25"></i> Data tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection