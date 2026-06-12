@extends('app')

@section('title', 'Devices — NetBox')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Devices</h2>
            <p class="text-muted small mb-0">Kelola dan monitoring aset infrastruktur jaringan Anda</p>
        </div>
        <a href="{{ route('devices.create') }}" class="btn btn-primary" style="background: #2a5298; border: none; padding: 10px 20px; border-radius: 8px;">
            <i class="bi bi-plus-lg me-1"></i> Tambah Perangkat
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 8px;">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-nowrap">
                    <thead style="background: #f8f9fa; color: #495057; font-size: 0.8rem; font-weight: 700; border-bottom: 2px solid #e9ecef;">
                        <tr>
                            <th class="p-3">NAME</th>
                            <th>STATUS</th>
                            <th>TENANT</th>
                            <th>SITE</th>
                            <th>LOCATION</th>
                            <th>RACK</th>
                            <th>ROLE</th>
                            <th>MANUFACTURER</th>
                            <th>TYPE</th>
                            <th>IP ADDRESS</th>
                            <th class="text-center" style="width: 100px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.9rem;">
    @forelse($devices as $device)
        <tr class="border-bottom">
            <td class="p-3"><span class="fw-bold text-primary">{{ $device->name }}</span></td>
            <td><span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Active</span></td>
            <td class="text-muted">{{ $device->tenant ?? '—' }}</td>
            <td><span class="text-dark fw-semibold">{{ $device->site ?? '—' }}</span></td>
            <td class="text-secondary">{{ $device->location ?? '—' }}</td>
            <td>{{ $device->rack ?? '—' }}</td>
            <td><span class="badge bg-secondary-subtle text-secondary px-2 py-1">{{ $device->role ?? '—' }}</span></td>
            <td>{{ $device->manufacturer ?? '—' }}</td>
            <td><code>{{ $device->type ?? '—' }}</code></td>
            <td><span class="font-monospace text-dark">{{ $device->ip_address ?? '—' }}</span></td>
            
            <td class="text-center align-middle">
                <div class="d-flex justify-content-center gap-1">
                    <a href="{{ route('devices.edit', $device->id) }}" class="btn btn-sm btn-light border text-primary d-flex align-items-center justify-content-center p-0" style="width: 30px; height: 30px;" title="Edit">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form action="{{ route('devices.destroy', $device->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-light border text-danger d-flex align-items-center justify-content-center p-0" style="width: 30px; height: 30px;" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="11" class="text-center p-5 text-muted">
                <div class="d-flex flex-column align-items-center">
                    <i class="bi bi-hdd-network display-4 mb-2"></i>
                    <span>Belum ada data perangkat yang terdaftar di sistem.</span>
                </div>
            </td>
        </tr>
    @endforelse
</tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection