@extends('app')

@section('title', 'Device Types — NetBox')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="fw-bold text-dark mb-1">Device Types</h2>
            <p class="text-muted small mb-0">Model-model fisik perangkat beserta spesifikasi sasisnya</p>
        </div>
        <a href="{{ route('device-types.create') }}" class="btn btn-primary" style="background: #2a5298; border: none; padding: 10px 20px; border-radius: 8px;">
            <i class="bi bi-plus-lg me-1"></i> Tambah Device Type
        </a>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-nowrap">
                    <thead style="background: #f8f9fa; color: #495057; font-size: 0.8rem; font-weight: 700; border-bottom: 2px solid #e9ecef;">
                        <tr>
                            <th class="p-3" style="width: 40px;"></th>
                            <th>DEVICE TYPE</th>
                            <th>MANUFACTURER</th>
                            <th>PART NUMBER</th>
                            <th>U HEIGHT</th>
                            <th>FULL DEPTH</th>
                            <th>DEVICE COUNT</th>
                            <th class="text-center" style="width: 100px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.9rem;">
    @isset($device_types)
        @forelse($device_types as $type)
            <tr class="border-bottom">
                <td>{{ $type->id }}</td> <td>{{ $type->model_name }}</td> <td>{{ $type->manufacturer->name }}</td> <td><code>{{ $type->slug }}</code></td>
                <td>{{ $type->height }} U</td>
                <td>{{ $type->description ?? '—' }}</td>
                <td class="text-center">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ route('device-types.edit', $type->id) }}" class="btn btn-light border text-primary"><i class="bi bi-pencil-square"></i></a>
                        <form action="{{ route('device-types.destroy', $type->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus device type ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-light border text-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            @endforelse
    @endisset
</tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection