@extends('layouts.auth', ['title' => 'Register'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">

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
    <div class="card card-primary">
        <div class="card-header">
            <h4>Register</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register_action') }}" id="formRegister">
                @csrf

                {{-- Nama --}}
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input 
                        id="name" 
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        autofocus>

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Username --}}
                <div class="form-group">
                    <label for="username">Username</label>
                    <input 
                        id="username" 
                        type="text"
                        class="form-control @error('username') is-invalid @enderror"
                        name="username" 
                        value="{{ old('username') }}" 
                        required>

                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Jabatan Hidden --}}
                <input type="hidden" name="jabatan" value="-">

                {{-- Password --}}
                <div class="row">
                    <div class="form-group col-6">
                        <label for="password">Password</label>
                        <input 
                            id="password" 
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password" 
                            required>

                        <small class="text-muted">Minimal 6 karakter</small>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input 
                            id="password_confirmation" 
                            type="password"
                            class="form-control"
                            name="password_confirmation" 
                            required>
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

    {{-- Popup Alert Password --}}
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
@endsection

@push('scripts')
    <script src="{{ asset('library/jquery-pwstrength/pwstrength.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <script>
        const formRegister = document.getElementById('formRegister');
        const passwordInput = document.getElementById('password');
        const passwordAlert = document.getElementById('passwordAlert');
        const closePasswordAlert = document.getElementById('closePasswordAlert');

        formRegister.addEventListener('submit', function(e) {
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