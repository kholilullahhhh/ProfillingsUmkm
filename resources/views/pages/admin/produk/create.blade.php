@extends('layouts.app', ['title' => 'Tambah Data Produk'])

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Produk</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">
                        <a href="{{ route('umkm.index') }}">Data UMKM</a>
                    </div>
                    <div class="breadcrumb-item active">Tambah Produk</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form Tambah Produk UMKM</h4>
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

                                <form action="{{ route('produk.store') }}" method="POST">
                                    @csrf

                                    {{-- hidden relasi ke UMKM --}}
                                    <input type="hidden" name="umkm_id" value="{{ $umkm_id ?? '' }}">

                                    <div class="row">
                                        <!-- Left -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Produk <span class="text-danger">*</span></label>
                                                <input type="text" name="nama_produk" class="form-control"
                                                    value="{{ old('nama_produk') }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <input type="text" name="kategori" class="form-control"
                                                    value="{{ old('kategori') }}" placeholder="Contoh: Makanan, Minuman">
                                            </div>

                                            <div class="form-group">
                                                <label>Harga (Rp) <span class="text-danger">*</span></label>
                                                <input type="text" name="harga" class="form-control currency-input"
                                                    value="{{ old('harga') }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Stok <span class="text-danger">*</span></label>
                                                <input type="number" name="stok" class="form-control"
                                                    value="{{ old('stok') }}" min="0" required>
                                            </div>
                                        </div>

                                        <!-- Right -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Satuan</label>
                                                <input type="text" name="satuan" class="form-control"
                                                    value="{{ old('satuan') }}" placeholder="pcs, kg, liter">
                                            </div>

                                            <div class="form-group">
                                                <label>Status <span class="text-danger">*</span></label>
                                                <select name="status" class="form-control" required>
                                                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" rows="5">{{ old('deskripsi') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group text-center mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg px-5">
                                            <i class="fas fa-save mr-2"></i> Simpan Produk
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
        // Format harga
        var cleave = new Cleave('.currency-input', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalMark: ',',
            delimiter: '.'
        });
    </script>
@endpush