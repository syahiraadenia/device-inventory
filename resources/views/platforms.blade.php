@extends('app')

@section('title', 'Platforms — NetBox')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Platforms</h2>
            <p class="text-muted small mb-0">Sistem operasi atau sistem perangkat lunak yang berjalan pada perangkat</p>
        </div>
        <a href="{{ route('platforms.create') }}" class="btn btn-primary" style="background: #2a5298; border: none; padding: 10px 20px; border-radius: 8px;">
            <i class="bi bi-plus-lg me-1"></i> Tambah Platform
        </a>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-nowrap">
                    <thead style="background: #f8f9fa; color: #495057; font-size: 0.8rem; font-weight: 700; border-bottom: 2px solid #e9ecef;">
                        <tr>
                            <th class="p-3" style="width: 40px;"></th>
                            <th>NAME</th>
                            <th>MANUFACTURER</th>
                            <th>DEVICES</th>
                            <th>VMS</th>
                            <th>DESCRIPTION</th>
                            <th class="text-center" style="width: 100px;">AKSI</th>
                        </tr>
                    </thead>
<tbody style="font-size: 0.9rem;">
    @forelse($platforms as $platform)
        <tr class="border-bottom">
            <td class="p-3"></td> 
            
            <td><span class="fw-bold text-primary">{{ $platform->name }}</span></td>
            
            <td>{{ $platform->manufacturer->name ?? '—' }}</td>
            
            <td>-</td>
            
            <td>-</td>
            
            <td class="text-muted">{{ $platform->description ?? '—' }}</td>
            
            <td class="text-center">
                <div class="btn-group btn-group-sm">
                    <a href="{{ route('platforms.edit', $platform->id) }}" class="btn btn-light border text-primary">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form action="{{ route('platforms.destroy', $platform->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-light border text-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center p-5 text-muted">Belum ada data platform.</td>
        </tr>
    @endforelse
</tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection