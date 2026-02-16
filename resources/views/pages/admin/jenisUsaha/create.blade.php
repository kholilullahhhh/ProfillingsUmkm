@extends('layouts.app', ['title' => 'Tambah Jenis Usaha'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
        <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Jenis Usaha</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('jenis_usaha.store') }}" method="POST">
                            @csrf

                            <div class="card">
                                <div class="card-header">
                                    <h4>Form Tambah Jenis Usaha</h4>
                                </div>

                                <div class="card-body">

                                    {{-- Nama Jenis Usaha --}}
                                    <div class="form-group row mb-4">
                                        <label for="nama_jenis"
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                            Nama Jenis Usaha <span class="text-danger">*</span>
                                        </label>

                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" id="nama_jenis" name="nama_jenis"
                                                value="{{ old('nama_jenis') }}"
                                                class="form-control @error('nama_jenis') is-invalid @enderror"
                                                placeholder="Masukkan nama jenis usaha" required>

                                            @error('nama_jenis')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Deskripsi --}}
                                    <div class="form-group row mb-4">
                                        <label for="deskripsi"
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                            Deskripsi <span class="text-danger">*</span>
                                        </label>

                                        <div class="col-sm-12 col-md-7">
                                            <textarea id="deskripsi" name="deskripsi"
                                                class="summernote @error('deskripsi') is-invalid @enderror"
                                                required>{{ old('deskripsi') }}</textarea>

                                            @error('deskripsi')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Tombol --}}
                                    <div class="form-group row mb-4">
                                        <div class="col-md-7 offset-md-3">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Simpan
                                            </button>

                                            <a href="{{ route('jenis_usaha.index') }}" class="btn btn-warning">
                                                <i class="fas fa-arrow-left"></i> Kembali
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
        <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>
        <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

        <script>
            $(document).ready(function () {
                $('.summernote').summernote({
                    height: 200,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link']],
                        ['view', ['fullscreen', 'codeview']]
                    ]
                });
            });
        </script>
    @endpush

@endsection 