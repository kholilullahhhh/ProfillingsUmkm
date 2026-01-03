@extends('layouts.app', ['title' => 'Tambah Jadwal'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Jadwal</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form action="{{ route('jadwal.store') }}" method="POST">
                            @csrf

                            <div class="card">
                                <div class="card-header">
                                    <h4>Form Jadwal</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Guru</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select name="user_id" class="form-control select2" required>
                                                <option value="">Pilih Guru</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Mata
                                            Pelajaran</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select name="mapel_id" class="form-control select2" required>
                                                <option value="">Pilih Mata Pelajaran</option>
                                                @foreach($mapel as $m)
                                                    <option value="{{ $m->id }}">{{ $m->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="date" name="tanggal" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jam
                                            Mulai</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="time" name="jam_mulai" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jam
                                            Selesai</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="time" name="jam_selesai" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Input Nilai</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select name="keterangan" class="form-control" required>
                                                <option value="">Pilih Keterangan</option>
                                                <option value="ya">Aktif</option>
                                                <option value="tidak">Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
                                            <a href="{{ route('jadwal.index') }}" class="btn btn-warning">Kembali</a>
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
        <script>
            $(document).ready(function () {
                $('.select2').select2();
            });
        </script>
    @endpush
@endsection