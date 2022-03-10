@extends('layouts.auth')

@section('title', __('Forgot Your Password'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h4 class="text-center pt-5">{{ __('Forgot Your Password') }}</h4>
                <form id="forgot-form" action="{{ route('password.email') }}" method="post">
                    @csrf
                    <p>{{ __('Send Email') }}</p>
                    <div class="form-group required">
                        <label class="font-weight-bold" for="email">{{ __('Email address') }}</label>
                        <input placeholder="Email address" type="email" class="form-control email" id="email" name="email">
                        <small class="text-danger">{{ $errors->first('email') }}</small>
                    </div>
                    <div class="form-group pt-1 m-auto d-flex justify-content-center">
                        <button class="btn btn-custom" type="submit">
                            {{ __('Sent') }}
                        </button>
                        <a class="btn btn-custom" href=" {{ route('login') }}">{{ __('Login') }}</a>
                    </div>
                </form>
                @if (Session::has('status'))
                    <h4 class="text-center pt-3">{{ __('sendMailSuccess') }}</h4>
                @endif
            </div>

        </div>
    </div>
@endsection
