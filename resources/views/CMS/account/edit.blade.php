@extends('layout.app')

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
                <div class="alert alert-success">
                    {{ session('error') }}
                </div>
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
                                <span class="fs-1 ">Account details</span>
                                <span class="fs-6 mb-4 text-body-secondary">Kindly enter your details.</span>
                            </div>
                            <form action="{{ route($userRole . '.account.update', ['account' => $account->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('First name') }}</label>
                                    <div class="col-md-6">
                                        <input id="first_name" type="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                        name="first_name" value="{{ old('first_name', $account->detail->first_name ?? '') }}" placeholder="First name"
                                        required autocomplete="first_name" autofocus>
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="middle_name" class="col-md-4 col-form-label text-md-end">{{ __('Middle name') }}</label>
                                    <div class="col-md-6">
                                        <input id="middle_name" type="middle_name" class="form-control @error('middle_name') is-invalid @enderror"
                                        name="middle_name" value="{{ old('middle_name', $account->detail->middle_name ?? '') }}" placeholder="Middle name"
                                        required autocomplete="middle_name" autofocus>
                                        @error('middle_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last name') }}</label>
                                    <div class="col-md-6">
                                        <input id="last_name" type="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                        name="last_name" value="{{ old('last_name', $account->detail->last_name ?? '') }}" placeholder="Last name"
                                        required autocomplete="last_name" autofocus>
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="department_id" class="col-md-4 col-form-label text-md-end">{{ __('Department') }}</label>
                                    <div class="col-md-6">
                                        <select name="department_id" id="department_id" class="form-select @error('department_id') is-invalid @enderror" required autofocus>
                                            <option value="">Choose..</option>
                                            @foreach($listOfDepartment as $department)
                                            <option value="{{ $department->id }}" {{ $account && $account->detail->department_id === $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-11 col-md-6 d-flex justify-content-end">
                                        <input type="submit" value="Save" class="btn btn-primary">
                                        <a href="{{ route($userRole . '.account.index') }}">
                                            <input type="button" value="back" class="btn btn-secondary mx-1">
                                        </a>
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