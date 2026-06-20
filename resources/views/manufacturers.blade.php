@extends('app')

@section('title', 'Manufacturers — Inventory System')

@section('content')
<style>
    .gradient-header { background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%); color: white; border-radius: 12px; }
    .table-hover tbody tr:hover { background-color: #f0f7ff !important; border-left: 4px solid #2a5298; }
    .count-badge { background: #e2e8f0; color: #475569; font-weight: 700; border-radius: 12px; padding: 2px 10px; font-size: 0.8rem; }
</style>

<div class="container-fluid py-4">
    <div class="gradient-header p-4 mb-4 shadow-sm d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold m-0">Manufacturers</h2>
            <p class="opacity-75 mb-0">Daftar perusahaan produsen atau brand perangkat keras</p>
        </div>
        <a href="{{ route('manufacturers.create') }}" class="btn btn-light text-primary fw-bold shadow-sm px-4 py-2" style="border-radius: 8px;">
            <i class="bi bi-plus-lg me-1"></i> Add Manufacturer
        </a>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead style="background: #f8fafc;">
                    <tr class="text-uppercase small text-secondary">
                        <th class="ps-4 py-3">Name</th>
                        <th>Device Types</th>
                        <th>Inventory</th>
                        <th>Platforms</th>
                        <th>Description</th>
                        <th>Slug</th>
                        <th class="text-center pe-4">Action</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.9rem;">
                    @forelse($manufacturers as $manufacturer)
                        <tr class="table-hover">
                            <td class="ps-4 py-3 fw-bold text-dark">{{ $manufacturer->name }}</td>
                            <td><span class="count-badge">{{ $manufacturer->device_types_count }}</span></td>
                            <td><span class="count-badge">{{ $manufacturer->inventory_items_count }}</span></td>
                            <td><span class="count-badge">{{ $manufacturer->platforms_count }}</span></td>
                            <td class="text-muted">{{ $manufacturer->description ?? '—' }}</td>
                            <td><code class="text-primary">{{ $manufacturer->slug }}</code></td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('manufacturers.edit', $manufacturer->id) }}" class="btn btn-sm btn-outline-primary border-0"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('manufacturers.destroy', $manufacturer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-buildings d-block display-4 mb-2 opacity-25"></i> Belum ada data manufacturer.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection