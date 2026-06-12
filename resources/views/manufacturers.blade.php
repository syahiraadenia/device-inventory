@extends('app')

@section('title', 'Manufacturers — NetBox')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="fw-bold text-dark mb-1">Manufacturers</h2>
            <p class="text-muted small mb-0">Daftar perusahaan produsen / brand dari perangkat keras</p>
        </div>
        <a href="{{ route('manufacturers.create') }}" class="btn btn-primary" style="background: #2a5298; border: none; padding: 10px 20px; border-radius: 8px;">
            <i class="bi bi-plus-lg me-1"></i> Tambah Manufacturer
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
                            <th>RACK TYPES</th>
                            <th>DEVICE TYPES</th>
                            <th>MODULE TYPES</th>
                            <th>INVENTORY ITEMS</th>
                            <th>PLATFORMS</th>
                            <th>DESCRIPTION</th>
                            <th>SLUG</th>
                            <th class="text-center" style="width: 100px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.9rem;">
                        @forelse($manufacturers as $manufacturer)
                            <tr class="border-bottom">
                                <td class="p-3"></td>
                                <td><span class="fw-bold text-primary">{{ $manufacturer->name }}</span></td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="text-muted">{{ $manufacturer->description ?? '—' }}</td>
                                <td><code>{{ $manufacturer->slug }}</code></td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('manufacturers.edit', $manufacturer->id) }}" class="btn btn-light border text-primary"><i class="bi bi-pencil-square"></i></a>
                                        <form action="{{ route('manufacturers.destroy', $manufacturer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus manufacturer ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-light border text-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center p-5 text-muted">
                                    <i class="bi bi-building display-4 d-block mb-3 text-black-50"></i>
                                    Belum ada data manufacturer.
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