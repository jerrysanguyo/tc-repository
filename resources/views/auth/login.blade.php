@extends('layout.auth.login-reg')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center align-items-center" style="height: 80vh;">
            <div class="col-lg-8 col-md-12">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="card border-0 shadow">
                    <div class="card-body d-flex align-items-center" style="min-height: 300px;">
                        <div class="row w-100">
                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                <div class="text-center">
                                    <img src="{{ asset('image/city-logo.webp') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row text-center">
                                    <span class="fs-1 ">Sign in</span>
                                    <span class="fs-6 text-body-secondary">Enter your email address and password to access dashboard.</span>
                                    <span class="fs-6 mb-4">
                                        <a href="{{ route('registration') }}" class="text-decoration-none">Kindly create your account if you do not have one.</a>
                                    </span>
                                </div>
                                <form method="POST" action="{{ route('login.account') }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" placeholder="Email address"
                                            required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" placeholder="Password"
                                            required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Login') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link text-decoration-none" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection