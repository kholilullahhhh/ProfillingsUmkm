@extends('layouts.app', ['title' => 'Edit Jadwal'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Input Nilai</h1>
            </div>

                {{-- Jika Bukan Admin → Hanya detail (tidak bisa edit) --}}
                <div class="section-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <form action="{{ route('user.jadwal.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input required type="hidden" name="id" value="{{ $data->id }}" class="form-control">

                                <div class="card">
                                    <div class="card-header">
                                        <h4>Form Input Nilai</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Guru</label>
                                            <div class="col-sm-12 col-md-7">
                                                <select class="form-control select2" disabled>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}" {{ $data->user_id == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Mata Pelajaran</label>
                                            <div class="col-sm-12 col-md-7">
                                                <select class="form-control select2" disabled>
                                                    @foreach($mapel as $m)
                                                        <option value="{{ $m->id }}" {{ $data->mapel_id == $m->id ? 'selected' : '' }}>
                                                            {{ $m->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="date" class="form-control" value="{{ $data->tanggal }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jam Mulai</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="time" class="form-control" value="{{ $data->jam_mulai }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jam Selesai</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="time" class="form-control" value="{{ $data->jam_selesai }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Input Nilai</label>
                                            <div class="col-sm-12 col-md-7">
                                                <select name='keterangan' class="form-control">
                                                    <option value="ya" {{ $data->keterangan == 'ya' ? 'selected' : '' }}>Masuk</option>
                                                    <option value="tidak" {{ $data->keterangan == 'tidak' ? 'selected' : '' }}>Tidak Masuk</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                            <div class="col-sm-12 col-md-7">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <a href="{{ route('user.jadwal.index') }}" class="btn btn-warning">Kembali</a>
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
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>
    @endpush
@endsection
