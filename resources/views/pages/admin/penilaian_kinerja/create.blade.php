@extends('layouts.app', ['title' => 'Hitung KPI'])

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Hitung KPI Guru</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form Perhitungan KPI</h4>
                            </div>
                            <div class="card-body">
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                
                                <form action="{{ route('penilaian_kinerja.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="user_id">Pilih Guru</label>
                                        <select name="user_id" id="user_id" class="form-control" required>
                                            <option value="">Pilih Guru</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="bulan">Periode Penilaian</label>
                                        <input type="month" name="bulan" id="bulan" class="form-control"
                                            value="{{ old('bulan', date('Y-m')) }}" required>
                                        <small class="form-text text-muted">Pilih bulan dan tahun untuk penilaian</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-calculator"></i> Hitung KPI
                                    </button>
                                    <a href="{{ route('penilaian_kinerja.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection