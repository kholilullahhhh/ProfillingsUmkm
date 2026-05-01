    @extends('layouts.app', ['title' => 'Data UMKM'])

    @section('content')
        @push('styles')
            <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
            <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
            <link rel="stylesheet" href="{{ asset('library/sweetalert2/dist/sweetalert2.min.css') }}">
            <style>
                    .action-buttons {
                    display: flex;
                    gap: 0.5rem;
                }

                .btn-action {
                    padding: 0.375rem 0.75rem;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                }

                .btn-action i {
                    margin-right: 0.25rem;
                }
                
                .badge-mikro {
                    background-color: #28a745;
                    color: white;
                    padding: 5px 10px;
                    border-radius: 3px;
                    font-size: 12px;
                }
                
                .badge-kecil {
                    background-color: #17a2b8;
                    color: white;
                    padding: 5px 10px;
                    border-radius: 3px;
                    font-size: 12px;
                }
                
                .badge-menengah {
                    background-color: #ffc107;
                    color: #212529;
                    padding: 5px 10px;
                    border-radius: 3px;
                    font-size: 12px;
                }
                
                .badge-binaan {
                    background-color: #28a745;
                }
                
                .badge-non-binaan {
                    background-color: #dc3545;
                }
            </style>
        @endpush

        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Data UMKM Binaan</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                        <div class="breadcrumb-item">Data UMKM Binaan</div>
                    </div>
                </div>

                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Daftar UMKM Binaan</h4>
                                    <div class="card-header-action">
                                        <a href="{{ route('umkm.create') }}" class="btn btn-primary btn-icon icon-left">
                                            <i class="fas fa-plus"></i> Tambah Data UMKM
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-pegawai">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama Usaha</th>
                                                    <th>Pemilik</th>
                                                    <th>Jenis Usaha</th>
                                                    <th>Alamat</th>
                                                    <th>Kabupaten</th>
                                                    <th>Skala Usaha</th>
                                                    <th>Status Binaan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($datas as $index => $umkm)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $umkm->nama_usaha }}</td>
                                                        <td>{{ $umkm->pemilik }}</td>
                                                        <td>{{ $umkm->jenisUsaha->nama_jenis ?? '-' }}</td>
                                                        <td>{{ Str::limit($umkm->alamat, 50) }}</td>
                                                        <td>{{ $umkm->kabupaten }}</td>
                                                        <td>
                                                            @if($umkm->skala_usaha == 'mikro')
                                                                <span class="badge-mikro">Mikro</span>
                                                            @elseif($umkm->skala_usaha == 'kecil')
                                                                <span class="badge-kecil">Kecil</span>
                                                            @else
                                                                <span class="badge-menengah">Menengah</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($umkm->status_binaan == 1)
                                                                <span class="badge badge-success">Binaan</span>
                                                            @else
                                                                <span class="badge badge-danger">Non Binaan</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="action-buttons">
                                                                <a href="{{ route('umkm.edit', $umkm->id) }}"
                                                                    class="btn btn-warning btn-action">
                                                                    <i class="fas fa-edit"></i> Edit
                                                                </a>
                                                                <a href="{{ route('produk.index', $umkm->id) }}"
                                                                    class="btn btn-primary btn-action">
                                                                    <i class="fas fa-eye"></i> Produk
                                                                </a>
                                                                <form action="{{ route('umkm.hapus', $umkm->id) }}" method="POST"
                                                                    class="d-inline delete-form">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-action delete-btn">
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

                    @if(auth()->user()->role == 'user')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Semua UMKM Terdaftar</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-semua-umkm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Usaha</th>
                                    <th>Pemilik</th>
                                    <th>Jenis Usaha</th>
                                    <th>Alamat</th>
                                    <th>Kabupaten</th>
                                    <th>Skala Usaha</th>
                                    <th>Status Binaan</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($allDatas as $index => $umkm)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $umkm->nama_usaha }}</td>
                                        <td>{{ $umkm->pemilik }}</td>
                                        <td>{{ $umkm->jenisUsaha->nama_jenis ?? '-' }}</td>
                                        <td>{{ Str::limit($umkm->alamat, 50) }}</td>
                                        <td>{{ $umkm->kabupaten }}</td>

                                        <td>
                                            @if($umkm->skala_usaha == 'mikro')
                                                <span class="badge-mikro">Mikro</span>
                                            @elseif($umkm->skala_usaha == 'kecil')
                                                <span class="badge-kecil">Kecil</span>
                                            @else
                                                <span class="badge-menengah">Menengah</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($umkm->status_binaan == 1)
                                                <span class="badge badge-success">Binaan</span>
                                            @else
                                                <span class="badge badge-danger">Non Binaan</span>
                                            @endif
                                        </td>

                                         <td>
                                              <div class="action-buttons">
                                                  <a href="{{ route('produk.index', $umkm->id) }}"
                                                      class="btn btn-primary btn-action">
                                                      <i class="fas fa-eye"></i> Produk
                                                  </a>
                                                  
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
    @endif
                </div>
            </section>
        </div>

        @push('scripts')
            <!-- SweetAlert2 from CDN -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js"></script>

            <!-- Other scripts -->
            <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>

            <script>
$(document).ready(function () {

    // TABLE PERTAMA
    if (!$.fn.DataTable.isDataTable('#table-pegawai')) {
        $('#table-pegawai').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100]
        });
    }

    // TABLE KEDUA
    if ($('#table-semua-umkm').length) {
        if (!$.fn.DataTable.isDataTable('#table-semua-umkm')) {
            $('#table-semua-umkm').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100]
            });
        }
    }

    // DELETE CONFIRMATION
    $('.delete-btn').click(function (e) {
        e.preventDefault();

        let form = $(this).closest('form');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data UMKM ini akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    @if(session('message'))
    Swal.fire({
        icon: 'success',
        title: 'Sukses!',
        text: '{{ session("message") }}',
        timer: 3000,
        showConfirmButton: true
    });
    @endif

    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session("error") }}'
    });
    @endif

});
</script>

            
        @endpush
    @endsection