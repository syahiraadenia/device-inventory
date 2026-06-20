@extends('app')

@section('title', 'Devices — Inventory System')

@section('content')
<style>
    .gradient-header { background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%); color: white; border-radius: 12px; }
    .table-hover tbody tr:hover { background-color: #f0f7ff !important; border-left: 4px solid #2a5298; }
    .status-pill { padding: 4px 10px; border-radius: 6px; font-size: 0.70rem; font-weight: 700; text-transform: uppercase; }
    .small-text { font-size: 0.75rem; color: #64748b; }
</style>

<div class="container-fluid py-4">
    <div class="gradient-header p-4 mb-4 shadow-sm d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold m-0">Devices Inventory</h2>
            <p class="opacity-75 mb-0">Manajemen aset jaringan perusahaan</p>
        </div>
        <a href="{{ route('devices.create') }}" class="btn btn-light text-primary fw-bold shadow-sm px-4 py-2">
            <i class="bi bi-plus-lg me-1"></i> Add Device
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <form action="{{ route('devices.index') }}" method="GET">
                <div class="input-group shadow-sm">
                    <input type="text" name="search" class="form-control border-0" placeholder="Cari nama perangkat..." value="{{ request('search') }}">
                    <button class="btn btn-white bg-white border-0 text-secondary" type="submit"><i class="bi bi-search"></i></button>
                    @if(request('search'))
                        <a href="{{ route('devices.index') }}" class="btn btn-white bg-white border-0 text-danger"><i class="bi bi-x-lg"></i></a>
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
                        <th class="ps-4 py-3">Device Name</th>
                        <th>Serial / Manufacturer</th>
                        <th>Dept / Role</th>
                        <th>Site</th> 
                        <th>Purchase</th>
                        <th>Status</th>
                        <th class="text-center pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($devices as $device)
                        <tr class="table-hover">
                            <td class="ps-4 py-3">
                                <div class="fw-bold text-dark">{{ $device->name }}</div>
                                <div class="small-text">{{ $device->owner_name ?? 'No Owner' }}</div>
                            </td>
                            <td>
                                <div class="fw-bold small">{{ $device->serial_number ?? '-' }}</div>
                                <div class="small-text">{{ $device->manufacturer ?? '-' }}</div>
                            </td>
                            <td>
                                <div class="fw-bold small">{{ $device->department ?? '-' }}</div>
                                <div class="small-text">{{ $device->deviceRole->name ?? 'No Role' }}</div>
                            </td>
                            <td class="small fw-semibold">{{ $device->site->name ?? '-' }}</td>
                            <td class="small">{{ $device->purchase_date ?? '-' }}</td>
                            <td>
                                @php
                                    $statusClass = [
                                        'Available' => 'bg-success-subtle text-success',
                                        'In-Use'    => 'bg-info-subtle text-info',
                                        'Broken'    => 'bg-danger-subtle text-danger'
                                    ];
                                @endphp
                                <span class="status-pill {{ $statusClass[$device->status] ?? 'bg-secondary-subtle text-secondary' }}">
                                    {{ $device->status }}
                                </span>
                            </td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('devices.edit', $device->id) }}" class="btn btn-sm btn-outline-primary border-0"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('devices.destroy', $device->id) }}" method="POST" onsubmit="return confirm('Hapus perangkat?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-cpu d-block display-4 mb-2 opacity-25"></i> Perangkat tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection