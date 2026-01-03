@extends('layouts.app', ['title' => 'Edit Indikator'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Indikator Kinerja</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12 col-lg-8 offset-lg-2">
                        <form action="{{ route('indikator.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input required type="hidden" name="id" value="{{ $data->id }}" class="form-control">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Form Edit Indikator</h4>
                                </div>
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label>Nama Indikator</label>
                                        <input type="text" name="name" class="form-control" required
                                            placeholder="Masukkan Nama Indikator" value="{{ old('name', $data->name) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Skor</label>
                                        <input type="number" name="skor" class="form-control" required
                                            placeholder="Masukkan Skor (0-100)" min="0" max="100"
                                            value="{{ old('skor', $data->skor) }}">
                                        <small class="text-muted">Skala 0 sampai 100</small>
                                    </div>

                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea name="description" class="form-control" rows="3"
                                            placeholder="Masukkan Deskripsi Indikator">{{ old('description', $data->description) }}</textarea>
                                    </div>
                                </div>

                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update
                                    </button>
                                    <a href="{{ route('indikator.index') }}" class="btn btn-warning">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
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