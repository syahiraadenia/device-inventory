@extends('app')

@section('title', 'Dashboard — NetBox')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Dashboard</h2>
            <p class="text-muted small mb-0">Ringkasan infrastruktur jaringan Anda secara real-time</p>
        </div>
        <button onclick="downloadPDF()" class="btn btn-danger shadow-sm d-print-none">
            <i class="bi bi-file-earmark-pdf-fill me-2"></i> Download Laporan Lengkap (PDF)
        </button>
    </div>

    <div class="row g-3 mb-4">
        <div class="col">
            <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 12px;">
                <h6 class="text-muted small text-uppercase">Devices</h6>
                <h3 class="fw-bold mb-0 text-primary">{{ $deviceCount }}</h3>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 12px;">
                <h6 class="text-muted small text-uppercase">Roles</h6>
                <h3 class="fw-bold mb-0 text-danger">{{ $roleCount }}</h3>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 12px;">
                <h6 class="text-muted small text-uppercase">Platforms</h6>
                <h3 class="fw-bold mb-0 text-success">{{ $platformCount }}</h3>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 12px;">
                <h6 class="text-muted small text-uppercase">Manufacturers</h6>
                <h3 class="fw-bold mb-0 text-warning">{{ $manufacturerCount }}</h3>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 12px;">
                <h6 class="text-muted small text-uppercase">Types</h6>
                <h3 class="fw-bold mb-0 text-info">{{ $typeCount }}</h3>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 12px;">
                <h5 class="fw-bold mb-4">Statistik Aset Jaringan</h5>
                <canvas id="inventoryChart" height="80"></canvas>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 12px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-journal-text me-2"></i>Lampiran Rincian Data Inventaris Global</h5>
                    <span class="badge bg-secondary d-print-none">Live Data</span>
                </div>
                
                <div class="mb-5">
                    <h6 class="fw-bold text-primary mb-2"><i class="bi bi-hdd-network-fill me-2"></i>Daftar Perangkat (Devices)</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>NAME</th>
                                    <th>STATUS</th>
                                    <th>TENANT</th>
                                    <th>SITE</th>
                                    <th>LOCATION</th>
                                    <th>RACK</th>
                                    <th>ROLE</th>
                                    <th>MANUFACTURER</th>
                                    <th>TYPE</th>
                                    <th>IP ADDRESS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($devices as $device)
                                    <tr>
                                        <td class="fw-bold text-primary">{{ $device['name'] }}</td>
                                        <td><span class="badge bg-success-subtle text-success">{{ $device['status'] ?? 'Active' }}</span></td>
                                        <td class="text-muted">{{ $device['tenant'] ?? '-' }}</td>
                                        <td>{{ $device['site'] ?? '-' }}</td>
                                        <td class="text-muted">{{ $device['location'] ?? '-' }}</td>
                                        <td>{{ $device['rack'] ?? '-' }}</td>
                                        <td><span class="badge bg-info-subtle text-info">{{ $device['role'] ?? '-' }}</span></td>
                                        <td>{{ $device['manufacturer'] ?? '-' }}</td>
                                        <td class="text-danger-emphasis">{{ $device['type'] ?? '-' }}</td>
                                        <td class="font-monospace small text-danger fw-bold">{{ $device['ip_address'] ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center py-3 text-muted">Belum ada perangkat yang terdaftar di sistem.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h6 class="fw-bold text-danger mb-2"><i class="bi bi-tags-fill me-2"></i>Device Roles</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Role</th>
                                        <th>Slug / Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($roles as $role)
                                        <tr>
                                            <td class="fw-bold text-dark">{{ $role['name'] }}</td>
                                            <td class="text-muted">{{ $role['slug'] ?? 'Default Role' }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="2" class="text-center text-muted py-2">Tidak ada data role.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <h6 class="fw-bold text-success mb-2"><i class="bi bi-cpu-fill me-2"></i>Platforms</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Platform</th>
                                        <th>Slug / Format</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($platforms as $platform)
                                        <tr>
                                            <td class="fw-bold text-success">{{ $platform['name'] }}</td>
                                            <td class="text-muted">{{ $platform['slug'] ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="2" class="text-center text-muted py-2">Tidak ada data platform.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6 class="fw-bold text-warning-emphasis mb-2"><i class="bi bi-building-fill me-2"></i>Manufacturers</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Produsen</th>
                                        <th>Slug</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($manufacturers as $man)
                                        <tr>
                                            <td class="fw-bold text-warning-emphasis">{{ $man['name'] }}</td>
                                            <td class="text-muted">{{ $man['slug'] ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="2" class="text-center text-muted py-2">Tidak ada data produsen.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <h6 class="fw-bold text-info mb-2"><i class="bi bi-layers-fill me-2"></i>Device Types</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Model Tipe</th>
                                        <th>Slug</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($types as $type)
                                        <tr>
                                            <td class="fw-bold text-info-emphasis">{{ $type['name'] }}</td>
                                            <td class="text-muted">{{ $type['slug'] ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="2" class="text-center text-muted py-2">Tidak ada data tipe perangkat.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .sidebar, .d-print-none, button, .badge.bg-secondary {
            display: none !important;
        }
        .main-content {
            margin-left: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }
        body {
            background-color: #fff !important;
            font-size: 11px; /* Dikecilkan sedikit lagi agar tabel 10 kolom muat kertas */
        }
        .card {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
        }
        .table {
            width: 100% !important;
            border-collapse: collapse !important;
        }
        .table th, .table td {
            padding: 5px !important; 
        }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('inventoryChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartData['labels']) !!},
            datasets: [{
                label: 'Jumlah Aset',
                data: {!! json_encode($chartData['data']) !!},
                backgroundColor: ['#4e73df', '#e74a3b', '#1cc88a', '#f6c23e', '#36b9cc'],
                borderRadius: 8
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false } }
            }
        }
    });

    function downloadPDF() {
        const originalTitle = document.title;
        document.title = "NetBox_Full_Inventory_Report_" + new Date().toISOString().slice(0,10);
        window.print();
        document.title = originalTitle;
    }
</script>
@endsection