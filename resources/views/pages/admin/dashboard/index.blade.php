@extends('layouts.app', ['title' => 'Dashboard Absensi'])

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

            .status-badge {
                padding: 0.35rem 0.75rem;
                border-radius: 50rem;
                font-size: 0.75rem;
                font-weight: 600;
                letter-spacing: 0.5px;
            }

            .bg-hadir {
                background-color: rgba(40, 167, 69, 0.1);
                color: var(--success);
            }

            .bg-tidak_hadir {
                background-color: rgba(220, 53, 69, 0.1);
                color: var(--danger);
            }

            .bg-izin {
                background-color: rgba(23, 162, 184, 0.1);
                color: var(--info);
            }

            .recent-attendance::-webkit-scrollbar {
                width: 6px;
            }

            .recent-attendance::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }

            .recent-attendance::-webkit-scrollbar-thumb {
                background: #c1c1c1;
                border-radius: 10px;
            }

            .recent-attendance::-webkit-scrollbar-thumb:hover {
                background: #a8a8a8;
            }

            .attendance-item {
                transition: all 0.3s ease;
                border-left: 4px solid transparent;
            }

            .attendance-item:hover {
                transform: translateX(5px);
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05);
            }

            .attendance-item.bg-hadir {
                border-left-color: var(--success);
            }

            .attendance-item.bg-tidak_hadir {
                border-left-color: var(--danger);
            }

            .attendance-item.bg-izin {
                border-left-color: var(--info);
            }

            .section-header {
                padding: 20px 0;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                margin-bottom: 30px;
            }

            .breadcrumb-item.active {
                color: var(--primary);
            }
        </style>
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <div>
                        <h1 class="h3 mb-0 text-gray-800">Dashboard Absensi</h1>
                        <p class="mb-0 text-muted">Ringkasan dan analisis kehadiran rapat</p>
                    </div>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><i class="bi bi-house-door"></i> Dashboard</div>
                    </div>
                </div>
            </div>

            @if (session('role') == 'admin')
                <!-- Summary Cards Row -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="dashboard-card card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="card-icon">
                                        <i class="bi bi-calendar-event"></i>
                                    </div>
                                    <div>
                                        <div class="card-label">Total Agenda Rapat</div>
                                        <div class="card-value">{{ $totalAgendas }}</div>
                                    </div>
                                </div>
                                <div class="mt-3 text-right">
                                    <a href="{{ route('agenda.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
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
                                        <i class="bi bi-check-circle"></i>
                                    </div>
                                    <div>
                                        <div class="card-label">Hadir</div>
                                        <div class="card-value">{{ $hadirCount }}</div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-success" style="width: {{ $hadirPercentage }}%"></div>
                                    </div>
                                    <small class="text-muted">{{ $hadirPercentage }}% dari total absensi</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="dashboard-card card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="card-icon"
                                        style="background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);">
                                        <i class="bi bi-x-circle"></i>
                                    </div>
                                    <div>
                                        <div class="card-label">Tidak Hadir</div>
                                        <div class="card-value">{{ $tidakHadirCount }}</div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-danger" style="width: {{ $tidakHadirPercentage }}%"></div>
                                    </div>
                                    <small class="text-muted">{{ $tidakHadirPercentage }}% dari total absensi</small>
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
                                        <i class="bi bi-info-circle"></i>
                                    </div>
                                    <div>
                                        <div class="card-label">Izin</div>
                                        <div class="card-value">{{ $izinCount }}</div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-info" style="width: {{ $izinPercentage }}%"></div>
                                    </div>
                                    <small class="text-muted">{{ $izinPercentage }}% dari total absensi</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="row mb-4">
                    <!-- Attendance Statistics Chart -->
                    <div class="col-lg-8 mb-4">
                        <div class="dashboard-card card h-100">
                            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Statistik Kehadiran Bulan Ini</h6>
                                <div class="d-flex">
                                    <select id="monthSelect" class="form-control form-control-sm mr-2">
                                        @foreach(range(1, 12) as $month)
                                            <option value="{{ $month }}" {{ $selectedMonth == $month ? 'selected' : '' }}>
                                                {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <select id="yearSelect" class="form-control form-control-sm">
                                        @foreach(range(date('Y') - 2, date('Y')) as $year)
                                            <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <div id="attendanceChart"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Status Chart -->
                    <div class="col-lg-4 mb-4">
                        <div class="dashboard-card card h-100">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Distribusi Kehadiran</h6>
                            </div>
                            <div class="card-body">
                                <div id="attendanceStatusChart"></div>
                                <div class="mt-4 text-center small">
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-success"></i> Hadir ({{ $hadirCount }})
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-danger"></i> Tidak Hadir ({{ $tidakHadirCount }})
                                    </span>
                                    <span>
                                        <i class="fas fa-circle text-info"></i> Izin ({{ $izinCount }})
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Tables Row -->
                <div class="row">
                    <!-- Recent Attendance -->
                    <div class="col-lg-6 mb-4">
                        <div class="dashboard-card card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Absensi Terbaru</h6>
                                <div>
                                    <a href="{{ route('absensi.index') }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-list-ul"></i> Lihat Semua
                                    </a>
                                </div>
                            </div>
                            <div class="card-body recent-attendance" style="max-height: 350px; overflow-y: auto;">
                                @forelse($recentAttendances as $attendance)
                                    <div class="attendance-item mb-3 p-3 rounded bg-{{ $attendance->status }}">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="d-flex align-items-center mb-1">
                                                    <div class="avatar-sm mr-2">
                                                        <span class="avatar-title rounded-circle bg-light text-dark">
                                                            {{ $attendance->user ? substr($attendance->user->name, 0, 1) : '?' }}
                                                        </span>
                                                    </div>
                                                    <h6 class="font-weight-bold mb-0">
                                                        {{ $attendance->user->name ?? 'User tidak ditemukan' }}
                                                    </h6>
                                                </div>
                                                <small class="text-muted">
                                                    <i class="bi bi-calendar-event"></i> {{ $attendance->agenda->judul }} •
                                                    <i class="bi bi-clock"></i>
                                                    {{ \Carbon\Carbon::parse($attendance->agenda->tgl_kegiatan)->format('d M Y') }}
                                                </small>
                                            </div>
                                            <div class="text-right">
                                                <span class="status-badge bg-{{ $attendance->status }}">
                                                    {{ ucfirst(str_replace('_', ' ', $attendance->status)) }}
                                                </span>
                                                <div class="text-muted small mt-1">
                                                    @if($attendance->keterangan)
                                                        <i class="bi bi-chat-left-text"></i>
                                                        {{ Str::limit($attendance->keterangan, 20) }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-4">
                                        <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                                        <p class="mt-2">Belum ada data absensi</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Agendas -->
                    <div class="col-lg-6 mb-4">
                        <div class="dashboard-card card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Agenda Mendatang</h6>
                                <div>
                                    <a href="{{ route('agenda.create') }}" class="btn btn-sm btn-success">
                                        <i class="bi bi-plus"></i> Tambah
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                @forelse($upcomingAgendas as $agenda)
                                    <div class="mb-3 p-3 border rounded">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="font-weight-bold mb-0">{{ $agenda->judul }}</h6>
                                            <span class="badge badge-primary">
                                                {{ \Carbon\Carbon::parse($agenda->tgl_kegiatan)->format('d M') }}
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted">
                                                <i class="bi bi-clock"></i> {{ $agenda->jam_mulai }}
                                            </small>
                                            <small class="text-muted">
                                                <i class="bi bi-geo-alt"></i> {{ $agenda->tempat_kegiatan }}
                                            </small>
                                        </div>
                                        <div class="mt-2">
                                            <a href="{{ route('absensi.create') }}?agenda_id={{ $agenda->id }}"
                                                class="btn btn-sm btn-outline-success">Absensi</a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-4">
                                        <i class="bi bi-calendar-check text-muted" style="font-size: 3rem;"></i>
                                        <p class="mt-2">Tidak ada agenda mendatang</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.3/dist/apexcharts.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            // Initialize attendance chart
            var attendanceChart = new ApexCharts(document.querySelector("#attendanceChart"), {
                series: [
                    {
                        name: 'Hadir',
                        data: @json($monthlyHadir)
                    },
                    {
                        name: 'Tidak Hadir',
                        data: @json($monthlyTidakHadir)
                    },
                    {
                        name: 'Izin',
                        data: @json($monthlyIzin)
                    }
                ],
                chart: {
                    type: 'bar',
                    height: '100%',
                    stacked: true,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        borderRadius: 4,
                        columnWidth: '55%',
                    },
                },
                colors: ['#28a745', '#dc3545', '#17a2b8'],
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
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Kehadiran'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + " orang"
                        }
                    }
                }
            });
            attendanceChart.render();

            // Initialize attendance status chart
            var attendanceStatusChart = new ApexCharts(document.querySelector("#attendanceStatusChart"), {
                series: [{{ $hadirCount }}, {{ $tidakHadirCount }}, {{ $izinCount }}],
                chart: {
                    type: 'donut',
                    height: 350
                },
                labels: ['Hadir', 'Tidak Hadir', 'Izin'],
                colors: ['#28a745', '#dc3545', '#17a2b8'],
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
            attendanceStatusChart.render();

            // Handle filter changes
            $('#monthSelect, #yearSelect').change(function () {
                const month = $('#monthSelect').val();
                const year = $('#yearSelect').val();
                window.location.href = "{{ route('dashboard') }}?month=" + month + "&year=" + year;
            });
        </script>
    @endpush
@endsection