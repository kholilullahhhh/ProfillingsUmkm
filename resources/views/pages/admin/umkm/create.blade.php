@extends('layouts.app', ['title' => 'Tambah Data UMKM'])

@push('styles')
    <style>
        .custom-alert-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.45);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 99999;
        }

        .custom-alert-overlay.show {
            display: flex;
        }

        .custom-alert-box {
            background: #ffffff;
            width: 90%;
            max-width: 420px;
            padding: 32px 26px;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 18px 45px rgba(0, 0, 0, 0.28);
            animation: popupScale 0.25s ease;
        }

        .custom-alert-icon {
            width: 76px;
            height: 76px;
            margin: 0 auto 18px;
            border-radius: 50%;
            background: #fff3cd;
            color: #ff9800;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
        }

        .custom-alert-box h5 {
            font-weight: 700;
            margin-bottom: 10px;
            color: #34395e;
        }

        .custom-alert-box p {
            color: #6c757d;
            font-size: 15px;
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .password-input-error {
            border-color: #fc544b !important;
        }

        .password-input-error:focus {
            border-color: #fc544b !important;
            box-shadow: 0 0 0 0.2rem rgba(252, 84, 75, 0.18) !important;
        }

        @keyframes popupScale {
            from {
                transform: scale(0.85);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data UMKM</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="{{ route('umkm.index') }}">Data UMKM</a>
                    </div>
                    <div class="breadcrumb-item active">Tambah UMKM</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Formulir Pendaftaran UMKM Binaan</h4>
                            </div>

                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible show fade">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert">
                                                <span>&times;</span>
                                            </button>

                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                <form action="{{ route('umkm.store') }}" method="POST" id="formTambahUmkm">
                                    @csrf

                                    <div class="row">
                                        <!-- Left Column -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Usaha <span class="text-danger">*</span></label>
                                                <input 
                                                    type="text" 
                                                    name="nama_usaha" 
                                                    class="form-control"
                                                    value="{{ old('nama_usaha') }}" 
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label>Nama Pemilik <span class="text-danger">*</span></label>
                                                <input 
                                                    type="text" 
                                                    name="pemilik" 
                                                    class="form-control"
                                                    value="{{ old('pemilik') }}" 
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label>Jenis Usaha <span class="text-danger">*</span></label>
                                                <select name="jenis_usaha_id" class="form-control" required>
                                                    <option value="">Pilih Jenis Usaha</option>
                                                    @foreach ($jenisUsahas as $jenis)
                                                        <option 
                                                            value="{{ $jenis->id }}"
                                                            {{ old('jenis_usaha_id') == $jenis->id ? 'selected' : '' }}>
                                                            {{ $jenis->nama_jenis }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Alamat <span class="text-danger">*</span></label>
                                                <textarea 
                                                    name="alamat" 
                                                    class="form-control" 
                                                    rows="3" 
                                                    required>{{ old('alamat') }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Kabupaten/Kota <span class="text-danger">*</span></label>
                                                <input 
                                                    type="text" 
                                                    name="kabupaten" 
                                                    class="form-control"
                                                    value="{{ old('kabupaten') }}" 
                                                    required>
                                            </div>
                                        </div>

                                        <!-- Right Column -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tahun Berdiri</label>
                                                <input 
                                                    type="number" 
                                                    name="tahun_berdiri" 
                                                    class="form-control"
                                                    value="{{ old('tahun_berdiri') }}" 
                                                    min="1900" 
                                                    max="{{ date('Y') }}"
                                                    placeholder="Contoh: 2020">
                                            </div>

                                            <div class="form-group">
                                                <label>Skala Usaha <span class="text-danger">*</span></label>
                                                <select name="skala_usaha" class="form-control" required>
                                                    <option value="">Pilih Skala Usaha</option>
                                                    <option value="mikro" {{ old('skala_usaha') == 'mikro' ? 'selected' : '' }}>
                                                        Mikro
                                                    </option>
                                                    <option value="kecil" {{ old('skala_usaha') == 'kecil' ? 'selected' : '' }}>
                                                        Kecil
                                                    </option>
                                                    <option value="menengah" {{ old('skala_usaha') == 'menengah' ? 'selected' : '' }}>
                                                        Menengah
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Omset per Tahun (Rp)</label>
                                                <input 
                                                    type="text" 
                                                    name="omset_per_tahun" 
                                                    class="form-control currency-input"
                                                    value="{{ old('omset_per_tahun') }}" 
                                                    placeholder="Contoh: 100000000">
                                                <small class="text-muted">Format: angka tanpa titik atau koma</small>
                                            </div>

                                            <div class="form-group">
                                                <label>Kontak (No. HP/Telepon)</label>
                                                <input 
                                                    type="number" 
                                                    name="kontak" 
                                                    class="form-control"
                                                    value="{{ old('kontak') }}" 
                                                    placeholder="Contoh: 081234567890">
                                            </div>

                                            <div class="form-group">
                                                <label>Status Binaan</label>
                                                <select name="status_binaan" class="form-control">
                                                    <option value="1" {{ old('status_binaan') == '1' ? 'selected' : '' }}>
                                                        Binaan
                                                    </option>
                                                    <option value="0" {{ old('status_binaan') == '0' ? 'selected' : '' }}>
                                                        Non Binaan
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <h5>Akun Login UMKM</h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username <span class="text-danger">*</span></label>
                                                <input 
                                                    type="text" 
                                                    name="username" 
                                                    class="form-control"
                                                    value="{{ old('username') }}" 
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jabatan</label>
                                                <input 
                                                    type="text" 
                                                    name="jabatan" 
                                                    class="form-control"
                                                    value="{{ old('jabatan') }}" 
                                                    placeholder="Contoh: Owner / Direktur">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password <span class="text-danger">*</span></label>
                                                <input 
                                                    type="password" 
                                                    name="password" 
                                                    id="password"
                                                    class="form-control" 
                                                    required>
                                                <small class="text-muted">Minimal 6 karakter</small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Konfirmasi Password <span class="text-danger">*</span></label>
                                                <input 
                                                    type="password" 
                                                    name="password_confirmation" 
                                                    id="password_confirmation"
                                                    class="form-control" 
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group text-center mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg px-5">
                                            <i class="fas fa-save mr-2"></i> 
                                            Simpan Data
                                        </button>

                                        <a href="{{ route('umkm.index') }}" class="btn btn-secondary btn-lg px-5 ml-2">
                                            <i class="fas fa-arrow-left mr-2"></i> 
                                            Kembali
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div id="passwordAlert" class="custom-alert-overlay">
            <div class="custom-alert-box">
                <div class="custom-alert-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>

                <h5>Password Terlalu Pendek</h5>

                <p>
                    Password harus memiliki minimal 6 karakter.
                    Silakan masukkan password yang lebih panjang agar akun lebih aman.
                </p>

                <button type="button" id="closePasswordAlert" class="btn btn-primary px-4">
                    Mengerti
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script>

    <script>
        // Format currency input
        var cleave = new Cleave('.currency-input', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalMark: ',',
            delimiter: '.'
        });

        // Auto-capitalize first letter of each word for name fields
        document.querySelectorAll('input[name="nama_usaha"], input[name="pemilik"]').forEach(function(input) {
            input.addEventListener('blur', function() {
                this.value = this.value.toLowerCase().replace(/\b\w/g, function(l) {
                    return l.toUpperCase();
                });
            });
        });

        // Password validation popup
        const formTambahUmkm = document.getElementById('formTambahUmkm');
        const passwordInput = document.getElementById('password');
        const passwordAlert = document.getElementById('passwordAlert');
        const closePasswordAlert = document.getElementById('closePasswordAlert');

        formTambahUmkm.addEventListener('submit', function(e) {
            if (passwordInput.value.length < 6) {
                e.preventDefault();

                passwordInput.classList.add('password-input-error');
                passwordAlert.classList.add('show');
                passwordInput.focus();
            }
        });

        closePasswordAlert.addEventListener('click', function() {
            passwordAlert.classList.remove('show');
        });

        passwordAlert.addEventListener('click', function(e) {
            if (e.target === passwordAlert) {
                passwordAlert.classList.remove('show');
            }
        });

        passwordInput.addEventListener('input', function() {
            if (passwordInput.value.length >= 6) {
                passwordInput.classList.remove('password-input-error');
            }
        });
    </script>
@endpush