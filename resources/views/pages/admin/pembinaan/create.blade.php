@extends('layouts.app', ['title' => 'Tambah Pembinaan'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Pembinaan</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form action="{{ route('pembinaan.store') }}" method="POST">
                            @csrf

                            <div class="card">
                                <div class="card-header">
                                    <h4>Form Pembinaan</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama UMKM</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select name="umkm_id" class="form-control select2" required>
                                                <option value="">Pilih UMKM</option>
                                                @foreach($umkm as $umkm)
                                                    <option value="{{ $umkm->id }}">{{ $umkm->nama_usaha }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Pembinaan</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="judul_pembinaan" class="form-control" required placeholder="Masukkan judul pembinaan">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Pembinaan</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="date" name="tanggal" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea name="deskripsi" class="summernote" placeholder="Masukkan deskripsi pembinaan"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Hasil Pembinaan</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea name="hasil" class="summernote" placeholder="Masukkan hasil pembinaan"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button type="submit" class="btn btn-primary">Simpan Pembinaan</button>
                                            <a href="{{ route('pembinaan.index') }}" class="btn btn-warning">Kembali</a>
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
        <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2();
                $('.summernote').summernote({
                    height: 200,
                    placeholder: 'Masukkan teks di sini...',
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'picture']],
                        ['view', ['codeview', 'help']]
                    ]
                });
            });
        </script>
    @endpush
@endsection