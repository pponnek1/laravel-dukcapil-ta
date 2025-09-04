@extends('layouts.auth')

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-6">
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-2">
                        <a href="{{ url('/') }}" class="app-brand-link">
                            <span class="app-brand-logo">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="" width="72" height="62">
                            </span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-4 text-center">Welcome to {{ config('app.name', 'Laravel') }}! 👋</h4>
                    <p class="mb-3">Silahkan login terlebih dahulu untuk mendaftar antrian</p>

                    <form method="POST" action="{{ route('login') }}" class="mb-4">
                        @csrf

                        <div class="mb-6">
                            <label for="email" class="form-label">{{ __('Masukan Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Masukan email anda" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4 form-password-toggle">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <div class="input-group input-group-merge">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="my-8">
                            <div class="d-flex justify-content-between">
                                <div class="form-check mb-0 ms-2">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                {{-- @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        <p class="mb-0">{{ __('Forgot Your Password?') }}</p>
                                    </a>
                                @endif --}}
                            </div>
                        </div>

                        <div class="mb-6">
                            <button type="submit" class="btn btn-primary d-grid w-100">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>

                    <p class="text-center mb-6">
                        <span>Belum memiliki akun ?</span>
                        <a href="{{ route('register') }}">
                            <span>Registrasi</span>
                        </a>
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
