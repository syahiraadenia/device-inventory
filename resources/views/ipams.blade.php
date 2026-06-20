@extends('app')

@section('title', 'IPAM — Inventory System')

@section('content')
<style>
    .gradient-header { background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%); color: white; border-radius: 12px; }
    .table-hover tbody tr:hover { background-color: #f0f7ff !important; border-left: 4px solid #2a5298; }
    .ip-badge { background: #dcfce7; color: #166534; font-weight: 700; border-radius: 12px; padding: 2px 10px; font-size: 0.8rem; }
</style>

<div class="container-fluid py-4">
    <div class="gradient-header p-4 mb-4 shadow-sm d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold m-0">IP Address Management</h2>
            <p class="opacity-75 mb-0">Daftar alokasi IP Address perangkat dalam jaringan</p>
        </div>
        <a href="{{ route('ipam.create') }}" class="btn btn-light text-primary fw-bold shadow-sm px-4 py-2" style="border-radius: 8px;">
            <i class="bi bi-plus-lg me-1"></i> Add IP Address
        </a>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead style="background: #f8fafc;">
                    <tr class="text-uppercase small text-secondary">
                        <th class="ps-4 py-3">IP Address</th>
                        <th>Device Name</th>
                        <th>Gateway</th>
                        <th>Status</th>
                        <th class="text-center pe-4">Action</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.9rem;">
                    @forelse($ipams as $ipam)
                        <tr class="table-hover">
                            <td class="ps-4 py-3 fw-bold text-primary"><i class="bi bi-globe me-2"></i>{{ $ipam->ip_address }}</td>
                            <td class="text-dark">{{ $ipam->device->name ?? 'N/A' }}</td>
                            <td class="text-muted">{{ $ipam->gateway ?? '—' }}</td>
                            <td><span class="ip-badge">Active</span></td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('ipam.edit', $ipam->id) }}" class="btn btn-sm btn-outline-primary border-0"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('ipam.destroy', $ipam->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-hdd-network d-block display-4 mb-2 opacity-25"></i> Belum ada data IP Address.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection