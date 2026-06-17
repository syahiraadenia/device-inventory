@extends('app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Sites</h2>
        <a href="{{ route('sites.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Site</a>
    </div>

    <table class="table table-hover border">
        <thead class="table-light">
            <tr>
                <th>NAME</th>
                <th>STATUS</th>
                <th>DESCRIPTION</th>
                <th>REGION</th>
                <th>GROUP</th>
                <th style="width: 100px;">AKSI</th> </tr>
        </thead>
        <tbody>
            @foreach($sites as $site)
            <tr>
                <td><strong>{{ $site->name }}</strong></td>
                <td><span class="badge bg-success">{{ ucfirst($site->status) }}</span></td>
                <td>{{ $site->description }}</td>
                <td>{{ $site->region->name ?? '-' }}</td>
                <td>{{ $site->group->name ?? '-' }}</td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <a href="{{ route('sites.edit', $site->id) }}" class="btn btn-light border text-primary">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('sites.destroy', $site->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-light border text-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection