@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <div class="custom-label">
                                <label for="name">{{ __('Name') }}</label>
                            </div>


                            <input id="name" type="text" class="w-50 m-auto form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback text-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group ">
                            <div class="custom-label">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                            </div>


                            <input id="email" type="email" class="w-50 m-auto form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback text-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <div class="custom-label">
                                <label for="password">{{ __('Password') }}</label>
                            </div>

                            <input id="password" type="password" class="w-50 m-auto form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback text-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <div class="custom-label">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            </div>


                            <input id="password-confirm" type="password" class="w-50 m-auto form-control" name="password_confirmation" required autocomplete="new-password">

                        </div>

                        <div class="form-group mb-0">
                            <div class="text-center">
                                <button type="submit" class="btn w-25 custom-btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
