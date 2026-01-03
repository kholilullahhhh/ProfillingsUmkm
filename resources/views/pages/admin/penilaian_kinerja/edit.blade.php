@extends('layouts.app', ['title' => 'Edit Penilaian Kinerja'])

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Penilaian Kinerja</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form Edit Penilaian</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('penilaian_kinerja.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $penilaian->id }}">
                                    
                                    <div class="form-group">
                                        <label for="user_id">Nama Guru</label>
                                        <select name="user_id" id="user_id" class="form-control" required disabled>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ $penilaian->user_id == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="bulan">Periode</label>
                                        <input type="text" class="form-control" 
                                            value="{{ \Carbon\Carbon::parse($penilaian->bulan)->format('F Y') }}" disabled>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="kehadiran_mengajar">Kehadiran Mengajar (%)</label>
                                        <input type="number" name="kehadiran_mengajar" id="kehadiran_mengajar" 
                                            class="form-control" min="0" max="100" step="0.01"
                                            value="{{ $penilaian->kehadiran_mengajar }}" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="ketepatan_waktu">Ketepatan Waktu (%)</label>
                                        <input type="number" name="ketepatan_waktu" id="ketepatan_waktu" 
                                            class="form-control" min="0" max="100" step="0.01"
                                            value="{{ $penilaian->ketepatan_waktu }}" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="jam_mengajar">Jam Mengajar (%)</label>
                                        <input type="number" name="jam_mengajar" id="jam_mengajar" 
                                            class="form-control" min="0" max="100" step="0.01"
                                            value="{{ $penilaian->jam_mengajar }}" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="pengisian_nilai">Pengisian Nilai (%)</label>
                                        <input type="number" name="pengisian_nilai" id="pengisian_nilai" 
                                            class="form-control" min="0" max="100" step="0.01"
                                            value="{{ $penilaian->pengisian_nilai }}" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="kehadiran_rapat">Kehadiran Rapat (%)</label>
                                        <input type="number" name="kehadiran_rapat" id="kehadiran_rapat" 
                                            class="form-control" min="0" max="100" step="0.01"
                                            value="{{ $penilaian->kehadiran_rapat }}" required>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Perubahan
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