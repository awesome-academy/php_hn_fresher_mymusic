@extends('layouts.auth')

@section('title', __('Reset Password'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h4 class="text-center pt-5">{{ __('Reset Password') }}</h4>
                <form id="forgot-form" action="{{ route('password.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <p class="text-center">{{ __('ResetDescription') }}</p>
                    <div class="form-group">
                        <label class="font-weight-bold" for="password">{{ __('Password') }}</label>
                        <input placeholder="{{ __('Password') }}" type="password" class="form-control password" id="password" name="password">
                        <small class="text-danger">{{ $errors->first('password') }}</small>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="password_confirmation">{{ __('Confirm Password') }}</label>
                        <input placeholder="{{ __('Confirm Password') }}" type="password" class="form-control password" id="password_confirmation" name="password_confirmation">
                        <small class="text-danger"></small>
                    </div>
                    <div class="form-group pt-1 m-auto d-flex justify-content-center">
                        <button class="btn btn-custom" type="submit">
                            {{ __('Reset') }}
                        </button>
                        <a class="btn btn-custom" href=" {{ route('login') }}">{{ __('Login') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
