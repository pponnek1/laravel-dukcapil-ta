@extends('layouts.auth')

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-6">
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-6">
                        <a href="{{ url('/') }}" class="app-brand-link">
                            <span class="app-brand-logo">
                                <!-- Logo SVG -->
                                <img src="{{ asset('assets/img/logo.png') }}" alt="" width="72" height="62">
                            </span>
                        </a>
                    </div>
                    <!-- /Logo -->

                    <h4 class="mb-1 text-center">Bergabung Sekarang dan Nikmati Layanannya! 🚀</h4>
                    <p class="mb-6 text-center text-muted">Silakan buat akun untuk mengakses layanan Dukcapil Kabupaten Klaten.</p>

                    <form method="POST" action="{{ route('register') }}" class="mb-4">
                        @csrf

                        <div class="mb-6">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Masukkan nama lengkap Anda" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Contoh: nama@email.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-6 form-password-toggle">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <div class="input-group input-group-merge">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Masukkan kata sandi">
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-6 form-password-toggle">
                            <label for="password-confirm" class="form-label">Konfirmasi Kata Sandi</label>
                            <div class="input-group input-group-merge">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi">
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
                                <label class="form-check-label" for="terms-conditions">
                                    Saya setuju dengan <a href="javascript:void(0);">kebijakan privasi dan syarat layanan</a>
                                </label>
                            </div>
                        </div>

                        <div class="mb-6">
                            <button type="submit" class="btn btn-primary d-grid w-100">
                                Daftar Sekarang
                            </button>
                        </div>
                    </form>

                    <p class="text-center">
                        <span>Sudah punya akun?</span>
                        <a href="{{ route('login') }}"><span>Masuk di sini</span></a>
                    </p>

                    <div class="divider my-6">
                        <div class="divider-text">Dukcapil Kabupaten Klaten</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
