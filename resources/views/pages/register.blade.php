@extends('layouts.auth')

@section('title', __('Register'))

@section('content')
    <div class="container-fluid my-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="register-form-layout">
                    <div class="title-heading">
                        <h3 class="text-center mb-3">{{ __('Sign up for free to start listening') }}</h3>
                    </div>
                    <div class="register-form">
                        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="email" class="required"> {{ __("What's your email?") }} </label>
                                    <input type="text" name="email" id="email" class="form-control form-control-lg" placeholder="{{ __('Enter your email here') }}" value="{{ old('email') ?? '' }}">
                                    <small class="text-danger">{{ $errors->first('email') ?? '' }}</small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="password" class="required"> {{ __("Enter your password") }} </label>
                                    <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="{{ __('Enter your password') }}">
                                    <small class="text-danger">{{ $errors->first('password') ?? '' }}</small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="password_confirmation" class="required"> {{ __("Confirm your password") }} </label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" placeholder="{{ __('Confirm your password') }}">
                                    <small class="text-danger">{{ $errors->first('password_confirmation') ?? '' }}</small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="first_name" class="required"> {{ __("What your's first name?") }} </label>
                                    <input type="text" name="first_name" id="first_name" class="form-control form-control-lg" placeholder="{{ __('Enter your first name here') }}" value="{{ old('first_name') ?? '' }}">
                                    <small class="text-danger">{{ $errors->first('first_name') ?? '' }}</small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="last_name" class="required"> {{ __("What your's last name?") }} </label>
                                    <input type="text" name="last_name" id="last_name" class="form-control form-control-lg" placeholder="{{ __('Enter your last name here') }}" value="{{ old('last_name') ?? '' }}">
                                    <small class="text-danger">{{ $errors->first('last_name') ?? '' }}</small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12 position-relative">
                                    <label> {{ __("Your avatar?") }} </label>
                                    <input type="file" name="avatar" id="avatar" class="avatar-input">
                                    <div class="d-flex justify-content-around">
                                        <label for="avatar" class="open-avatar-input">
                                            <img src="{{ asset('assets/img/upload-img.png') }}" alt="upload image">
                                            <span class="d-inline-block pb-3" style="width: 100px; text-align: center;">
                                                {{ __('Choose your avatar') }}
                                            </span>
                                        </label>
                                        <div class="avatar-preview"><img src="#"></div>
                                    </div>
                                    <small class="text-danger">{{ $errors->first('avatar') ?? '' }}</small>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="form-group col-lg-12 text-center">
                                    <button class="register-btn"> {{ __('Register') }} </button>
                                </div>
                            </div>
                        </form>
                        <p class="text-center mt-3">
                            {{ __('Do you have an account?') }} <a class="login-btn" href="{{ route('login') }}"> {{ __('Login now') }} </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function () {
            $('.avatar-preview').css('display', 'none');

            $('#avatar').change(function (e) {
                $('.open-avatar-input').css('box-shadow', 'none');
                const [file] = this.files;
                if (file) {
                    $('.avatar-preview>img').attr('src', URL.createObjectURL(file));
                    $('.avatar-preview').css('display', 'block');
                }
            });

            $('#avatar').on('dragover', function () {
                $('.open-avatar-input').css('box-shadow', '0px 0px 8px 0px #1ed760');
            });

            $('#avatar').on('dragleave', function () {
                $('.open-avatar-input').css('box-shadow', 'none');
            });
        });
    </script>
@endpush
