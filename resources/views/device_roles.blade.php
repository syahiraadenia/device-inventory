@extends('app')

@section('title', 'Device Roles — NetBox')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Device Roles</h2>
            <p class="text-muted small mb-0">Klasifikasi fungsi fungsional untuk perangkat dan virtual machine</p>
        </div>
        <a href="{{ route('device-roles.create') }}" class="btn btn-primary" style="background: #2a5298; border: none; padding: 10px 20px; border-radius: 8px;">
            <i class="bi bi-plus-lg me-1"></i> Tambah Role
        </a>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-nowrap">
                    <thead style="background: #f8f9fa; color: #495057; font-size: 0.8rem; font-weight: 700; border-bottom: 2px solid #e9ecef;">
                        <tr>
                            <th class="p-3" style="width: 40px;"></th> <th>NAME</th>                           <th>DEVICES</th>                        <th>VMS</th>                            <th>COLOR</th>                          <th>VM ROLE</th>                        <th>DESCRIPTION</th>                    <th class="text-center" style="width: 100px;">AKSI</th> </tr>
                    </thead>
                    <tbody style="font-size: 0.9rem;">
                        @isset($roles)
                            @forelse($roles as $role)
                                <tr class="border-bottom">
                                    <td class="p-3"></td>
                                    <td><span class="fw-bold text-primary">{{ $role->name }}</span></td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td><span class="badge" style="background-color: {{ $role->color }}">{{ $role->color }}</span></td>
                                    <td><span class="badge bg-secondary">No</span></td>
                                    <td class="text-muted">{{ $role->description ?? '—' }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('device-roles.edit', $role->id) }}" class="btn btn-light border text-primary"><i class="bi bi-pencil-square"></i></a>
                                            <form action="{{ route('device-roles.destroy', $role->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus role ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-light border text-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center p-5 text-muted">
                                        <i class="bi bi-tag display-4 d-block mb-3 text-black-50"></i>
                                        Belum ada data device role.
                                    </td>
                                </tr>
                            @endforelse
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection