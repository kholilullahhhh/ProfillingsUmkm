@extends('layouts.app', ['title' => 'Tambah Data UMKM'])

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data UMKM</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('umkm.index') }}">Data UMKM</a></div>
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

                                <form action="{{ route('umkm.store') }}" method="POST">
                                    @csrf

                                    <div class="row">
                                        <!-- Left Column -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Usaha <span class="text-danger">*</span></label>
                                                <input type="text" name="nama_usaha" class="form-control"
                                                    value="{{ old('nama_usaha') }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Nama Pemilik <span class="text-danger">*</span></label>
                                                <input type="text" name="pemilik" class="form-control"
                                                    value="{{ old('pemilik') }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Jenis Usaha <span class="text-danger">*</span></label>
                                                <select name="jenis_usaha_id" class="form-control" required>
                                                    <option value="">Pilih Jenis Usaha</option>
                                                    @foreach($jenisUsahas as $jenis)
                                                        <option value="{{ $jenis->id }}" {{ old('jenis_usaha_id') == $jenis->id ? 'selected' : '' }}>
                                                            {{ $jenis->nama_jenis }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Alamat <span class="text-danger">*</span></label>
                                                <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Kabupaten/Kota <span class="text-danger">*</span></label>
                                                <input type="text" name="kabupaten" class="form-control"
                                                    value="{{ old('kabupaten') }}" required>
                                            </div>
                                        </div>

                                        <!-- Right Column -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tahun Berdiri</label>
                                                <input type="number" name="tahun_berdiri" class="form-control" 
                                                    value="{{ old('tahun_berdiri') }}" min="1900" max="{{ date('Y') }}"
                                                    placeholder="Contoh: 2020">
                                            </div>

                                            <div class="form-group">
                                                <label>Skala Usaha <span class="text-danger">*</span></label>
                                                <select name="skala_usaha" class="form-control" required>
                                                    <option value="">Pilih Skala Usaha</option>
                                                    <option value="mikro" {{ old('skala_usaha') == 'mikro' ? 'selected' : '' }}>Mikro</option>
                                                    <option value="kecil" {{ old('skala_usaha') == 'kecil' ? 'selected' : '' }}>Kecil</option>
                                                    <option value="menengah" {{ old('skala_usaha') == 'menengah' ? 'selected' : '' }}>Menengah</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Omset per Tahun (Rp)</label>
                                                <input type="text" name="omset_per_tahun" class="form-control currency-input"
                                                    value="{{ old('omset_per_tahun') }}" placeholder="Contoh: 100000000">
                                                <small class="text-muted">Format: angka tanpa titik atau koma</small>
                                            </div>

                                            <div class="form-group">
                                                <label>Kontak (No. HP/Telepon)</label>
                                                <input type="text" name="kontak" class="form-control"
                                                    value="{{ old('kontak') }}" placeholder="Contoh: 081234567890">
                                            </div>

                                            <div class="form-group">
                                                <label>Status Binaan</label>
                                                <select name="status_binaan" class="form-control">
                                                    <option value="1" {{ old('status_binaan') == '1' ? 'selected' : '' }}>Binaan</option>
                                                    <option value="0" {{ old('status_binaan') == '0' ? 'selected' : '' }}>Non Binaan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 🔥 FORM AKUN LOGIN -->
                                    <hr>
                                    <h5>Akun Login UMKM</h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username <span class="text-danger">*</span></label>
                                                <input type="text" name="username" class="form-control"
                                                    value="{{ old('username') }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jabatan</label>
                                                <input type="text" name="jabatan" class="form-control"
                                                    value="{{ old('jabatan') }}" placeholder="Contoh: Owner / Direktur">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password <span class="text-danger">*</span></label>
                                                <input type="password" name="password" class="form-control" required>
                                                <small class="text-muted">Minimal 6 karakter</small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Konfirmasi Password <span class="text-danger">*</span></label>
                                                <input type="password" name="password_confirmation" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group text-center mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg px-5">
                                            <i class="fas fa-save mr-2"></i> Simpan Data
                                        </button>
                                        <a href="{{ route('umkm.index') }}" class="btn btn-secondary btn-lg px-5 ml-2">
                                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
    </script>
@endpush