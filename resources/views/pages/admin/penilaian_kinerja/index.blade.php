@extends('layouts.app', ['title' => 'Data Penilaian Kinerja'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
        <style>
            .detail-table {
                background-color: #f8f9fa;
                border-radius: 5px;
                padding: 15px;
                margin-top: 20px;
                display: none;
            }
            .detail-table table {
                width: 100%;
            }
            .detail-table th {
                background-color: #e9ecef;
            }
            .detail-toggle {
                cursor: pointer;
            }
            .detail-toggle:hover {
                text-decoration: underline;
            }
        </style>
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Penilaian Kinerja</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Daftar Penilaian Kinerja</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('penilaian_kinerja.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Hitung KPI
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-penilaian">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Pegawai</th>
                                                <th>Bulan</th>
                                                <th>Skor Akhir</th>
                                                <th>Kategori</th>
                                                <th>Keterangan</th>
                                                <th>Tanggal Penilaian</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $index => $penilaian)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $penilaian->user->name ?? 'N/A' }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($penilaian->bulan)->format('F Y') }}</td>
                                                    <td>{{ number_format($penilaian->skor_akhir, 2) }}</td>
                                                    <td>
                                                        @switch($penilaian->kategori)
                                                            @case('Sangat Baik')
                                                                <span class="badge badge-success">Sangat Baik</span>
                                                                @break
                                                            @case('Baik')
                                                                <span class="badge badge-primary">Baik</span>
                                                                @break
                                                            @case('Cukup')
                                                                <span class="badge badge-warning">Cukup</span>
                                                                @break
                                                            @case('Kurang')
                                                                <span class="badge badge-danger">Kurang</span>
                                                                @break
                                                            @default
                                                                <span class="badge badge-secondary">{{ $penilaian->kategori }}</span>
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        @switch($penilaian->kategori)
                                                            @case('Sangat Baik')
                                                                <span class="badge badge-success">A</span>
                                                                @break
                                                            @case('Baik')
                                                                <span class="badge badge-primary">B</span>
                                                                @break
                                                            @case('Cukup')
                                                                <span class="badge badge-warning">C</span>
                                                                @break
                                                            @case('Kurang')
                                                                <span class="badge badge-danger">D</span>
                                                                @break
                                                            @default
                                                                <span class="badge badge-secondary">{{ $penilaian->kategori }}</span>
                                                        @endswitch
                                                    </td>
                                                    <td>{{ $penilaian->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        <div>
                                                            <a href="{{ route('penilaian_kinerja.edit', $penilaian->id) }}" 
                                                               class="btn btn-warning btn-sm" title="Edit">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <button class="btn btn-info btn-sm toggle-detail" 
                                                                    data-id="{{ $penilaian->id }}" 
                                                                    data-name="{{ $penilaian->user->name ?? 'N/A' }}"
                                                                    data-bulan="{{ \Carbon\Carbon::parse($penilaian->bulan)->format('F Y') }}"
                                                                    data-kehadiran="{{ number_format($penilaian->kehadiran_mengajar, 2) }}"
                                                                    data-ketepatan="{{ number_format($penilaian->ketepatan_waktu, 2) }}"
                                                                    data-jam="{{ number_format($penilaian->jam_mengajar, 2) }}"
                                                                    data-nilai="{{ number_format($penilaian->pengisian_nilai, 2) }}"
                                                                    data-rapat="{{ number_format($penilaian->kehadiran_rapat, 2) }}"
                                                                    title="Lihat Detail Presentase">
                                                                <i class="fas fa-chart-pie"></i> Presentase
                                                            </button>
                                                            <form action="{{ route('penilaian_kinerja.hapus', $penilaian->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-danger btn-sm delete-btn" title="Hapus">
                                                                    <i class="fas fa-trash"></i> hapus
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Tabel Detail Presentase -->
                                <div class="detail-table" id="detail-table">
                                    <h4 id="detail-title">Detail Presentase Kinerja</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="20%">Nama Guru</th>
                                            <td id="detail-name">-</td>
                                        </tr>
                                        <tr>
                                            <th>Periode</th>
                                            <td id="detail-period">-</td>
                                        </tr>
                                        <tr>
                                            <th>Kehadiran Mengajar (%)</th>
                                            <td id="detail-kehadiran">-</td>
                                        </tr>
                                        <tr>
                                            <th>Ketepatan Waktu (%)</th>
                                            <td id="detail-ketepatan">-</td>
                                        </tr>
                                        <tr>
                                            <th>Jam Mengajar (%)</th>
                                            <td id="detail-jam">-</td>
                                        </tr>
                                        <tr>
                                            <th>Pengisian Nilai (%)</th>
                                            <td id="detail-nilai">-</td>
                                        </tr>
                                        <tr>
                                            <th>Kehadiran Rapat (%)</th>
                                            <td id="detail-rapat">-</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>

        <script>
            $(document).ready(function () {
                $('#table-penilaian').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
                    }
                });

                // Toggle detail presentase
                $('.toggle-detail').click(function() {
                    const id = $(this).data('id');
                    const name = $(this).data('name');
                    const bulan = $(this).data('bulan');
                    const kehadiran = $(this).data('kehadiran');
                    const ketepatan = $(this).data('ketepatan');
                    const jam = $(this).data('jam');
                    const nilai = $(this).data('nilai');
                    const rapat = $(this).data('rapat');
                    
                    // Isi data ke tabel detail
                    $('#detail-title').text('Detail Presentase Kinerja - ' + name);
                    $('#detail-name').text(name);
                    $('#detail-period').text(bulan);
                    $('#detail-kehadiran').text(kehadiran + '%');
                    $('#detail-ketepatan').text(ketepatan + '%');
                    $('#detail-jam').text(jam + '%');
                    $('#detail-nilai').text(nilai + '%');
                    $('#detail-rapat').text(rapat + '%');
                    
                    // Tampilkan tabel detail
                    $('#detail-table').slideDown();
                });

                // SweetAlert for delete confirmation
                $('.delete-btn').click(function (e) {
                    e.preventDefault();
                    var form = $(this).closest('form');

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data penilaian ini akan dihapus permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });

                // Show success message if exists
                @if(session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                        timer: 3000,
                        showConfirmButton: false
                    });
                @endif

                // Show error message if exists
                @if(session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: '{{ session('error') }}',
                    });
                @endif
            });
        </script>
    @endpush
@endsection