@extends('layouts.auth', ['title' => 'Register'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    @endpush

    <div class="card card-primary">
        <div class="card-header">
            <h4>Register</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register_action') }}">
                @csrf

                {{-- Nama --}}
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input id="name" type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autofocus>

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Username --}}
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text"
                        class="form-control @error('username') is-invalid @enderror"
                        name="username" value="{{ old('username') }}" required>

                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Jabatan --}}
                <div class="form-group">
                    <label for="jabatan">Jabatan / Usaha</label>
                    <input id="jabatan" type="text"
                        class="form-control @error('jabatan') is-invalid @enderror"
                        name="jabatan" value="{{ old('jabatan') }}">

                    @error('jabatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="row">
                    <div class="form-group col-6">
                        <label for="password">Password</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password" required>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password"
                            class="form-control"
                            name="password_confirmation" required>
                    </div>
                </div>

                {{-- Role Hidden --}}
                <input type="hidden" name="role" value="user">

                {{-- Tombol Register --}}
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Register
                    </button>
                </div>

                {{-- Kembali Login --}}
                <div class="text-center mt-3">
                    Sudah punya akun?
                    <a href="{{ route('login') }}">Login</a>
                </div>

            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('library/jquery-pwstrength/pwstrength.js') }}"></script>
        <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    @endpush
@endsection