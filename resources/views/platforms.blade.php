@extends('app')

@section('title', 'Platforms — Inventory System')

@section('content')
<style>
    .gradient-header { background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%); color: white; border-radius: 12px; }
    .table-hover tbody tr:hover { background-color: #f0f7ff !important; border-left: 4px solid #2a5298; }
</style>

<div class="container-fluid py-4">
    <div class="gradient-header p-4 mb-4 shadow-sm d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold m-0">Platforms</h2>
            <p class="opacity-75 mb-0">Sistem operasi atau sistem perangkat lunak yang berjalan pada perangkat</p>
        </div>
        <a href="{{ route('platforms.create') }}" class="btn btn-light text-primary fw-bold shadow-sm px-4 py-2" style="border-radius: 8px;">
            <i class="bi bi-plus-lg me-1"></i> Add Platform
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <form action="{{ route('platforms.index') }}" method="GET">
                <div class="input-group shadow-sm">
                    <input type="text" name="search" class="form-control border-0" placeholder="Cari platform..." value="{{ request('search') }}">
                    <button class="btn btn-white bg-white border-0 text-secondary" type="submit"><i class="bi bi-search"></i></button>
                    @if(request('search'))
                        <a href="{{ route('platforms.index') }}" class="btn btn-white bg-white border-0 text-danger"><i class="bi bi-x-lg"></i></a>
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
                        <th class="ps-4 py-3">Platform Name</th>
                        <th>Devices Count</th> <th>Description</th>
                        <th class="text-center pe-4">Action</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.9rem;">
                    @forelse($platforms as $platform)
                        <tr class="table-hover">
                            <td class="ps-4 py-3 fw-bold text-dark">{{ $platform->name }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $platform->devices_count }}</span></td>
                            <td class="text-muted">{{ $platform->description ?? '-' }}</td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('platforms.edit', $platform->id) }}" class="btn btn-sm btn-outline-primary border-0"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('platforms.destroy', $platform->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-layers d-block display-4 mb-2 opacity-25"></i> Data tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection