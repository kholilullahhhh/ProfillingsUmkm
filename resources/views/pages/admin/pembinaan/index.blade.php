@extends('layouts.app', ['title' => 'Data Pembinaan'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Pembinaan</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if (session('role') == 'admin')
                                    <!-- Navigation Buttons -->
                                    <a href="{{ route('pembinaan.create') }}" class="btn btn-primary text-white my-3">
                                        <i class="fas fa-plus"></i> Tambah Pembinaan
                                    </a>
                                @endif

                                <!-- Tables Section -->
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-pembinaan">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Nama UMKM</th>
                                                <th>Judul Pembinaan</th>
                                                <th>Tanggal</th>
                                                <th>Deskripsi</th>
                                                <th>Hasil</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $i => $data)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $data->umkm->nama_usaha ?? 'N/A' }}</td>
                                                    <td>{{ $data->judul_pembinaan }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d F Y') }}</td>
                                                    <td>{!! Str::limit($data->deskripsi, 50) ?? '-' !!}</td>
                                                    <td>{!! Str::limit($data->hasil, 50) ?? '-' !!}</td>
                                                    <td>
                                                        <a href="{{ route('pembinaan.edit', $data->id) }}"
                                                            class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                        @if (session('role') == 'admin')
                                                            <button onclick="deleteData({{ $data->id }}, 'pembinaan')"
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
            $(document).ready(function() {
                $('#table-pembinaan').DataTable({
                    paging: true,
                    searching: true,
                    order: [[3, 'desc']], // urut berdasarkan kolom Tanggal (index ke-3 dari <th>)
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
                    },
                    columnDefs: [
                        { orderable: false, targets: [6] }, // kolom Action tidak bisa sort
                        { searchable: false, targets: [0, 6] } // kolom # dan Action tidak bisa search
                    ]
                });
            });
        </script>
    @endpush
@endsection