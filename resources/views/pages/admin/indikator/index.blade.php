@extends('layouts.app', ['title' => 'Data Indikator'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Indikator Kinerja</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Daftar Indikator</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('indikator.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Tambah Indikator
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-indikator">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Indikator</th>
                                                <th>Skor</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $index => $indicator)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $indicator->name }}</td>
                                                    <td>
                                                        <span
                                                            class="badge badge-{{ $indicator->skor >= 80 ? 'success' : ($indicator->skor >= 60 ? 'warning' : 'danger') }}">
                                                            {{ $indicator->skor }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $indicator->description ?? '-' }}</td>
                                                    <td>
                                                        <div class="action-buttons">
                                                            <a href="{{ route('indikator.edit', $indicator->id) }}"
                                                                class="btn btn-warning btn-sm" title="Edit">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <form action="{{ route('indikator.hapus', $indicator->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                                    title="Hapus">
                                                                    <i class="fas fa-trash"></i> Hapus
                                                                </button>
                                                            </form>
                                                        </div>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>

        <script>
            $(document).ready(function () {
                $('#table-indikator').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
                    }
                });

                // SweetAlert for delete confirmation
                $('.delete-btn').click(function (e) {
                    e.preventDefault();
                    var form = $(this).closest('form');

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Indikator ini akan dihapus permanen!",
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