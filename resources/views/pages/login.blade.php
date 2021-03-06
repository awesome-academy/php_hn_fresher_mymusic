@extends('layouts.auth')

@section('title',__('LOG IN'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h4 class="text-center pt-5">{{ __('To continue, log in to MyMusic.') }}</h4>
                <div class="social-login">
                    <div class="facebook-login">
                        {{-- <a href="{{ route('social.redirect',['facebook']) }}"> --}}
                        <a href="#">
                            <span>
                                <i class="fa-brands fa-facebook"></i>
                                {{ __('login_facebook') }}
                            </span>
                        </a>
                    </div>
                    <div class="google-login">
                        <a href="{{ route('social.redirect',['google']) }}">
                            <span>
                                <i class="fa-brands fa-google"></i>
                                {{ __('login_google') }}
                            </span>
                        </a>
                    </div>
                </div>
                <form id="login-form" action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group required">
                        <label for="email">{{ __('Email address') }}</label>
                        <input placeholder="Email address" type="text" class="form-control email" id="email" name="email">
                        <small class="text-danger">{{ $errors->first('email') }}</small>
                    </div>
                    <div class="form-group required">
                        <label for="password">{{ __('Password') }}</label>
                        <input placeholder="Password" type="password" class="form-control" id="password" name="password">
                        <small class="text-danger">{{ $errors->first('password') }}</small>
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <a class="forget-password" href="{{ route('password.request') }}">{{ __('Forget Your Password?') }}</a></label>
                        <div class="custom-control custom-checkbox pt-2">
                            <input type="checkbox" class="custom-control-input" id="remember-me" name="remember"
                                data-parsley-multiple="remember-me">
                            <label class="custom-control-label" for="remember-me">{{ __('Remember me?') }}</label>
                        </div>
                    </div>
                    <div class="form-group pt-1">
                        <button class="btn btn-custom btn-block" type="submit">
                            <span>{{ __('Login') }}</span>
                        </button>
                    </div>
                </form>
                <div class="pt-3 mb-5 register-section">
                    <p>{{ __("Don't have an account?") }}</p>
                    <a class="btn-register btn-custom btn btn-block" href="/register">
                        <span class="text-dark mt-1">{{ __('SIGN UP FOR MYMUSIC') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
