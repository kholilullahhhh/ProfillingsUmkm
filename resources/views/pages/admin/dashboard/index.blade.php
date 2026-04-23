@extends('layouts.app', ['title' => 'Dashboard UMKM'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.28.3/dist/apexcharts.min.css">
        <style>
            :root {
                --primary: #4361ee;
                --primary-light: #eef2ff;
                --secondary: #3f37c9;
                --success: #28a745;
                --warning: #ffc107;
                --danger: #dc3545;
                --info: #17a2b8;
                --dark: #343a40;
                --light: #f8f9fa;
            }

            .dashboard-card {
                border: none;
                border-radius: 0.75rem;
                box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.05);
                transition: all 0.3s ease;
                overflow: hidden;
                background-color: white;
            }

            .dashboard-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
            }

            .card-icon {
                width: 60px;
                height: 60px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.75rem;
                color: white;
                margin-right: 1rem;
                background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            }

            .card-value {
                font-size: 1.75rem;
                font-weight: 700;
                line-height: 1.2;
                color: var(--dark);
            }

            .card-label {
                font-size: 0.875rem;
                color: #6c757d;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .chart-container {
                position: relative;
                height: 300px;
            }

            .omzet-card {
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .omzet-card:hover {
                transform: scale(1.02);
            }

            .recent-list::-webkit-scrollbar {
                width: 6px;
            }

            .recent-list::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }

            .recent-list::-webkit-scrollbar-thumb {
                background: #c1c1c1;
                border-radius: 10px;
            }

            .recent-list::-webkit-scrollbar-thumb:hover {
                background: #a8a8a8;
            }

            .list-item {
                transition: all 0.3s ease;
                border-left: 4px solid transparent;
                background-color: #f8f9fa;
            }

            .list-item:hover {
                transform: translateX(5px);
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05);
            }

            .section-header {
                padding: 20px 0;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                margin-bottom: 30px;
            }

            .breadcrumb-item.active {
                color: var(--primary);
            }

            .progress-custom {
                height: 8px;
                border-radius: 4px;
            }

            .status-badge {
                padding: 0.25rem 0.75rem;
                border-radius: 50rem;
                font-size: 0.75rem;
                font-weight: 600;
            }

            .stat-card {
                border-left: 4px solid var(--primary);
            }

            .text-gradient {
                background: linear-gradient(135deg, var(--primary), var(--secondary));
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
            }
        </style>
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <div>
                        <h1 class="h3 mb-0 text-gray-800">Dashboard UMKM</h1>
                        <p class="mb-0 text-muted">Ringkasan dan analisis data UMKM dan pembinaan</p>
                    </div>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><i class="bi bi-house-door"></i> Dashboard</div>
                    </div>
                </div>
            </div>

            <!-- Summary Cards Row -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card-icon">
                                    <i class="bi bi-building"></i>
                                </div>
                                <div>
                                    <div class="card-label">Total UMKM</div>
                                    <div class="card-value">{{ number_format($totalUMKM) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card-icon"
                                    style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                                <div>
                                    <div class="card-label">Total Produk</div>
                                    <div class="card-value">{{ number_format($totalProduk) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card-icon"
                                    style="background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);">
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <div>
                                    <div class="card-label">UMKM Binaan</div>
                                    <div class="card-value">{{ number_format($umkmBinaan) }}</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="progress progress-custom">
                                    <div class="progress-bar bg-info"
                                        style="width: {{ $totalUMKM > 0 ? round(($umkmBinaan / $totalUMKM) * 100) : 0 }}%">
                                    </div>
                                </div>
                                <small
                                    class="text-muted">{{ $totalUMKM > 0 ? round(($umkmBinaan / $totalUMKM) * 100) : 0 }}%
                                    dari total UMKM</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card-icon"
                                    style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);">
                                    <i class="bi bi-calendar-check"></i>
                                </div>
                                <div>
                                    <div class="card-label">Total Pembinaan</div>
                                    <div class="card-value">{{ number_format($totalPembinaan) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Omzet Summary Row -->
            <div class="row mb-4">
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card card omzet-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1">Total Omzet Tahunan</p>
                                    <h3 class="mb-0 text-gradient">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</h3>
                                </div>
                                <div class="card-icon"
                                    style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); width: 50px; height: 50px;">
                                    <i class="bi bi-calculator"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card card omzet-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1">Rata-rata Omzet per UMKM</p>
                                    <h3 class="mb-0 text-gradient">Rp {{ number_format($averageOmzet, 0, ',', '.') }}</h3>
                                </div>
                                <div class="card-icon"
                                    style="background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%); width: 50px; height: 50px;">
                                    <i class="bi bi-graph-up"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row 1 -->
            <div class="row mb-4">
                <!-- Distribusi Skala Usaha -->
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Distribusi Skala Usaha</h6>
                        </div>
                        <div class="card-body">
                            <div id="umkmScaleChart"></div>
                        </div>
                    </div>
                </div>

                <!-- Distribusi Status Binaan -->
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Status Binaan UMKM</h6>
                        </div>
                        <div class="card-body">
                            <div id="statusBinaanChart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row 2 -->
            <div class="row mb-4">
                <!-- Omzet per Skala Usaha -->
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Omzet per Skala Usaha</h6>
                        </div>
                        <div class="card-body">
                            <div id="omzetByScaleChart"></div>
                        </div>
                    </div>
                </div>

                <!-- Distribusi Jenis Usaha -->
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Distribusi Jenis Usaha</h6>
                        </div>
                        <div class="card-body">
                            <div id="jenisUsahaChart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pembinaan Charts -->
            <div class="row mb-4">
                <!-- Monthly Pembinaan Chart -->
                <div class="col-lg-8 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Grafik Pembinaan UMKM -
                                {{ DateTime::createFromFormat('!m', $selectedMonth)->format('F') }} {{ $selectedYear }}
                            </h6>
                            <div class="d-flex">
                                <select id="monthSelect" class="form-control form-control-sm mr-2">
                                    @foreach(range(1, 12) as $month)
                                        <option value="{{ $month }}" {{ $selectedMonth == $month ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                                <select id="yearSelect" class="form-control form-control-sm">
                                    @foreach(range(date('Y') - 2, date('Y') + 1) as $year)
                                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <div id="pembinaanChart"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistik Pembinaan -->
                <div class="col-lg-4 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Statistik Pembinaan</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <small class="text-muted">Total Sesi Pembinaan</small>
                                <h4 class="mb-0">{{ number_format($pembinaanStats['total_sessions']) }}</h4>
                            </div>
                            <div class="mb-4">
                                <small class="text-muted">Rata-rata per UMKM</small>
                                <h4 class="mb-0">{{ number_format($pembinaanStats['avg_per_umkm'], 1) }}</h4>
                            </div>
                            <div>
                                <small class="text-muted">Bulan dengan Data</small>
                                <h4 class="mb-0">{{ number_format($pembinaanStats['months_with_data']) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pembinaan Trend -->
            <div class="row mb-4">
                <div class="col-12 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Tren Pembinaan 6 Bulan Terakhir</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <div id="pembinaanTrendChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Tables Row -->
            <div class="row">
                <!-- Recent Pembinaan -->
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Pembinaan Terbaru</h6>
                            <div>
                                <a href="{{ route('pembinaan.index') }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-list-ul"></i> Lihat Semua
                                </a>
                            </div>
                        </div>
                        <div class="card-body recent-list" style="max-height: 400px; overflow-y: auto;">
                            @forelse($recentPembinaan as $pembinaan)
                                <div class="list-item mb-3 p-3 rounded">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="font-weight-bold mb-1">{{ $pembinaan->umkm->nama_usaha ?? 'UMKM' }}</h6>
                                            <small class="text-muted d-block">
                                                <i class="bi bi-calendar-event"></i>
                                                {{ Carbon\Carbon::parse($pembinaan->tanggal)->format('d M Y') }}
                                            </small>
                                            <small class="text-muted d-block mt-1">
                                                <i class="bi bi-journal-text"></i>
                                                {{ Str::limit($pembinaan->judul_pembinaan, 50) }}
                                            </small>
                                        </div>
                                        <div class="text-right">
                                            <span class="status-badge bg-success text-white">
                                                <i class="bi bi-check-circle"></i> Selesai
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                                    <p class="mt-2">Belum ada data pembinaan</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent UMKM -->
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">UMKM Terbaru Terdaftar</h6>
                            <div>
                                <a href="{{ route('umkm.index') }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-list-ul"></i> Lihat Semua
                                </a>
                            </div>
                        </div>
                        <div class="card-body recent-list" style="max-height: 400px; overflow-y: auto;">
                            @forelse($recentUMKM as $umkm)
                                <div class="list-item mb-3 p-3 rounded">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="font-weight-bold mb-1">{{ $umkm->nama_usaha }}</h6>
                                            <small class="text-muted d-block">
                                                <i class="bi bi-person"></i> {{ $umkm->pemilik }}
                                            </small>
                                            <small class="text-muted d-block">
                                                <i class="bi bi-building"></i> {{ ucfirst($umkm->skala_usaha) }}
                                            </small>
                                        </div>
                                        <div>
                                            <span
                                                class="status-badge {{ $umkm->status_binaan ? 'bg-success text-white' : 'bg-warning text-dark' }}">
                                                {{ $umkm->status_binaan ? 'Binaan' : 'Non Binaan' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <i class="bi bi-building-slash text-muted" style="font-size: 3rem;"></i>
                                    <p class="mt-2">Belum ada data UMKM</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Products & Top UMKM -->
            <div class="row">
                <!-- Recent Products -->
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Produk Terbaru</h6>
                            <div>
                                <a href="{{ route('produk.index', $umkm->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-list-ul"></i> Lihat Semua
                                </a>
                            </div>
                        </div>
                        <div class="card-body recent-list" style="max-height: 400px; overflow-y: auto;">
                            @forelse($recentProduk as $produk)
                                <div class="list-item mb-3 p-3 rounded">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="font-weight-bold mb-1">{{ $produk->nama_produk }}</h6>
                                            <small class="text-muted d-block">
                                                <i class="bi bi-building"></i> {{ $produk->umkm->nama_usaha ?? '-' }}
                                            </small>
                                            <small class="text-muted d-block">
                                                <i class="bi bi-tag"></i> {{ ucfirst($produk->kategori) }}
                                            </small>
                                        </div>
                                        <div class="text-right">
                                            <h6 class="mb-0 text-primary">Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                            </h6>
                                            <small class="text-muted">Stok: {{ $produk->stok }} {{ $produk->satuan }}</small>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <i class="bi bi-box-seam text-muted" style="font-size: 3rem;"></i>
                                    <p class="mt-2">Belum ada data produk</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Top UMKM by Pembinaan -->
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card card h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Top 5 UMKM dengan Pembinaan Terbanyak</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama UMKM</th>
                                            <th>Skala Usaha</th>
                                            <th>Jumlah Pembinaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($topUMKMByPembinaan as $umkm)
                                            <tr>
                                                <td>{{ $umkm->nama_usaha }}</td>
                                                <td>{{ ucfirst($umkm->skala_usaha ?? '-') }}</td>
                                                <td>
                                                    <span class="badge badge-info">{{ $umkm->pembinaan_count }} kali</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Belum ada data UMKM</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tahun Berdiri Distribution -->
            @if(count($tahunBerdiriDistribution) > 0)
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="dashboard-card card h-100">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Distribusi Tahun Berdiri UMKM</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <div id="tahunBerdiriChart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.3/dist/apexcharts.min.js"></script>

        <script>
            // UMKM by Scale Chart
            var umkmScaleChart = new ApexCharts(document.querySelector("#umkmScaleChart"), {
                series: [{{ $umkmByScale['mikro'] ?? 0 }}, {{ $umkmByScale['kecil'] ?? 0 }}, {{ $umkmByScale['menengah'] ?? 0 }}],
                chart: {
                    type: 'donut',
                    height: 350
                },
                labels: ['Mikro', 'Kecil', 'Menengah'],
                colors: ['#28a745', '#17a2b8', '#ffc107'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }],
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total',
                                    formatter: function (w) {
                                        return w.globals.seriesTotals.reduce((a, b) => {
                                            return a + b
                                        }, 0)
                                    }
                                }
                            }
                        }
                    }
                }
            });
            umkmScaleChart.render();

            // Status Binaan Chart
            var statusBinaanChart = new ApexCharts(document.querySelector("#statusBinaanChart"), {
                series: [{{ $umkmBinaan }}, {{ $umkmNonBinaan }}],
                chart: {
                    type: 'pie',
                    height: 350
                },
                labels: ['UMKM Binaan', 'UMKM Non Binaan'],
                colors: ['#28a745', '#dc3545'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            });
            statusBinaanChart.render();

            // Omzet by Scale Chart
            var omzetByScaleChart = new ApexCharts(document.querySelector("#omzetByScaleChart"), {
                series: [{
                    name: 'Omzet (Rp)',
                    data: [{{ $omzetByScale['mikro'] ?? 0 }}, {{ $omzetByScale['kecil'] ?? 0 }}, {{ $omzetByScale['menengah'] ?? 0 }}]
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: false,
                    }
                },
                colors: ['#4361ee'],
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return 'Rp ' + new Intl.NumberFormat('id-ID').format(val)
                    }
                },
                xaxis: {
                    categories: ['Mikro', 'Kecil', 'Menengah'],
                    title: {
                        text: 'Skala Usaha'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Omzet (Rp)'
                    },
                    labels: {
                        formatter: function (val) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(val)
                        }
                    }
                }
            });
            omzetByScaleChart.render();

            // Jenis Usaha Chart
            var jenisUsahaCategories = @json(array_keys($umkmByJenisUsaha));
            var jenisUsahaData = @json(array_values($umkmByJenisUsaha));

            var jenisUsahaChart = new ApexCharts(document.querySelector("#jenisUsahaChart"), {
                series: jenisUsahaData,
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        borderRadius: 4,
                    },
                },
                colors: ['#20c997'],
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val + " UMKM"
                    }
                },
                xaxis: {
                    categories: jenisUsahaCategories,
                    title: {
                        text: 'Jumlah UMKM'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jenis Usaha'
                    }
                }
            });
            jenisUsahaChart.render();

            // Monthly Pembinaan Chart
            var pembinaanChart = new ApexCharts(document.querySelector("#pembinaanChart"), {
                series: [{
                    name: 'Jumlah Pembinaan',
                    data: @json($monthlyPembinaan)
                }],
                chart: {
                    type: 'bar',
                    height: '100%',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        columnWidth: '55%',
                    },
                },
                colors: ['#4361ee'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: @json($dateLabels),
                    title: {
                        text: 'Tanggal'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Pembinaan'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + " kegiatan pembinaan"
                        }
                    }
                }
            });
            pembinaanChart.render();

            // Pembinaan Trend Chart
            var pembinaanTrendChart = new ApexCharts(document.querySelector("#pembinaanTrendChart"), {
                series: [{
                    name: 'Jumlah Pembinaan',
                    data: @json($monthlyPembinaanTrend)
                }],
                chart: {
                    type: 'line',
                    height: 350,
                    toolbar: {
                        show: true
                    }
                },
                colors: ['#4361ee'],
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                markers: {
                    size: 5
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val + " kegiatan"
                    }
                },
                xaxis: {
                    categories: @json($last6Months),
                    title: {
                        text: 'Bulan'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Pembinaan'
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + " kegiatan pembinaan"
                        }
                    }
                }
            });
            pembinaanTrendChart.render();

            @if(count($tahunBerdiriDistribution) > 0)
                // Tahun Berdiri Chart
                var tahunBerdiriCategories = @json(array_keys($tahunBerdiriDistribution));
                var tahunBerdiriData = @json(array_values($tahunBerdiriDistribution));

                var tahunBerdiriChart = new ApexCharts(document.querySelector("#tahunBerdiriChart"), {
                    series: [{
                        name: 'Jumlah UMKM',
                        data: tahunBerdiriData
                    }],
                    chart: {
                        type: 'bar',
                        height: 350,
                        toolbar: {
                            show: true
                        }
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 4,
                            columnWidth: '70%',
                        }
                    },
                    colors: ['#fd7e14'],
                    dataLabels: {
                        enabled: true,
                        formatter: function (val) {
                            return val + " UMKM"
                        }
                    },
                    xaxis: {
                        categories: tahunBerdiriCategories,
                        title: {
                            text: 'Tahun Berdiri'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Jumlah UMKM'
                        }
                    }
                });
                tahunBerdiriChart.render();
            @endif

            // Handle filter changes
            $('#monthSelect, #yearSelect').change(function () {
                const month = $('#monthSelect').val();
                const year = $('#yearSelect').val();
                window.location.href = "{{ route('dashboard') }}?month=" + month + "&year=" + year;
            });
        </script>
    @endpush
@endsection