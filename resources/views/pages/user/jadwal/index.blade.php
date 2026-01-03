@extends('layouts.app', ['title' => 'Data Jadwal'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Input Nilai</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if (session('role') == 'admin')
                                    <!-- Navigation Buttons -->
                                    <a href="{{ route('jadwal.create') }}" class="btn btn-primary text-white my-3">
                                        <i class="fas fa-plus"></i> Tambah Jadwal
                                    </a>
                                @endif

                                <!-- Tables Section -->
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-jadwal">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Nama Guru</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Tanggal</th>
                                                <th>Jam Mulai</th>
                                                <th>Jam Selesai</th>
                                                <th>Input Nilai</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $i => $data)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $data->user->name ?? 'N/A' }}</td>
                                                    <td>{{ $data->mapel->nama ?? 'N/A' }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d F Y') }}</td>
                                                    <td>{{ $data->jam_mulai }}</td>
                                                    <td>{{ $data->jam_selesai }}</td>
                                                    <td>
                                                        @if($data->keterangan == 'ya')
                                                            <span class="badge badge-success">Masuk</span>
                                                        @else
                                                            <span class="badge badge-secondary">Tidak Masuk</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('user.jadwal.edit', $data->id) }}"
                                                            class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Input
                                                            Nilai</a>
                                                        @if (session('role') == 'admin')

                                                            <button onclick="deleteData({{ $data->id }}, 'jadwal')"
                                                                class="btn btn-danger btn-sm" title="Hapus">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
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
        <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/page/modules-datatables.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#table-jadwal').DataTable({
                    paging: true,
                    searching: true,
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
                    },
                    columnDefs: [
                        { orderable: false, targets: [7] }, // Disable sorting for action column
                        { searchable: false, targets: [0, 7] } // Disable searching for # and action columns
                    ]
                });
            });
        </script>
    @endpush
@endsection