@extends('layouts.app', ['title' => 'Data Akun'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">

    <style>
        .role-select {
            height: 42px;
            border-radius: 6px;
            border: 1px solid #ced4da;
            font-size: 14px;
            padding: 8px 12px;
            background-color: #fff;
        }

        .role-select:focus {
            border-color: #6777ef;
            box-shadow: 0 0 0 0.2rem rgba(103, 119, 239, 0.15);
        }
    </style>
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Akun</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">

                                <form action="{{ route('akun.store') }}" method="POST">
                                    @csrf

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input 
                                                            name="name"
                                                            value="{{ old('name') }}"
                                                            required
                                                            placeholder="Masukkan Nama Akun"
                                                            type="text"
                                                            class="form-control @error('name') is-invalid @enderror">

                                                        @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Jabatan</label>
                                                        <input 
                                                            name="jabatan"
                                                            value="{{ old('jabatan') }}"
                                                            required
                                                            placeholder="Masukkan Jabatan Akun (- kalau tidak memiliki UMKM)"
                                                            type="text"
                                                            class="form-control @error('jabatan') is-invalid @enderror">

                                                        @error('jabatan')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input 
                                                            name="username"
                                                            value="{{ old('username') }}"
                                                            required
                                                            placeholder="Masukkan Username untuk login"
                                                            type="text"
                                                            class="form-control @error('username') is-invalid @enderror">

                                                        @error('username')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Role</label>
                                                        <select 
                                                            name="role"
                                                            required
                                                            class="form-control role-select @error('role') is-invalid @enderror">
                                                            <option value="">-- Pilih Role Akun --</option>
                                                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                                        </select>

                                                        @error('role')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input 
                                                            name="password"
                                                            required
                                                            placeholder="Masukkan Password"
                                                            type="password"
                                                            class="form-control @error('password') is-invalid @enderror">

                                                        @error('password')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Confirm Password</label>
                                                        <input 
                                                            name="password_confirmation"
                                                            required
                                                            placeholder="Masukkan Ulang Password"
                                                            type="password"
                                                            class="form-control @error('password_confirmation') is-invalid @enderror">

                                                        @error('password_confirmation')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-plus"></i>
                                                        Tambah Data Akun
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-temp">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($datas as $i => $data)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->username }}</td>
                                                    <td>{{ $data->role }}</td>
                                                    <td>
                                                        <a href="{{ route('akun.edit', $data->id) }}" class="btn btn-warning my-2">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <button 
                                                            type="button"
                                                            onclick="deleteData({{ $data->id }}, 'akun')"
                                                            class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush