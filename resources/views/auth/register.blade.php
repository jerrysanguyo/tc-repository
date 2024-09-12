@extends('layout.auth.login-reg')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <div class="text-center">
                                <img src="{{ asset('image/city-logo.webp') }}" alt="" class="img-fluid mx-5">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row text-center">
                                <span class="fs-1 ">Registration</span>
                                <span class="fs-6 text-body-secondary">Don't have an account? Create your <br> account, it takes less than a minute.</span>
                                <span class="fs-6 mb-4">
                                    <a href="{{ route('login') }}" class="text-decoration-none">Already have an account</a>
                                </span>
                            </div>
                            <form method="POST" action="{{ route('store.registration') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" placeholder="Email address"
                                        value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="contact_number" class="col-md-4 col-form-label text-md-end">{{ __('Contact number') }}</label>

                                    <div class="col-md-6">
                                        <input id="contact_number" type="text" class="form-control @error('contact_number') is-invalid @enderror"
                                            name="contact_number" placeholder="Contact number"
                                            value="{{ old('contact_number') }}" required autocomplete="Phone">

                                        @error('contact_number')
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
                                        required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" placeholder="Confirm password"
                                        required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <input type="submit" value="Submit" class="btn btn-primary">
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
@endsection
