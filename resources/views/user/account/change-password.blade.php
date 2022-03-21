@extends('layouts.auth')

@section('title', __('Change password'))

@section('content')
    <div class="row no-gutters account-container">
        @include('user.account.sidebar')
        <div class="col-10 account-content">
            <div class="card d-flex flex-column align-items-center">
                <h2 class="mb-0 p-3"> {{ __('Change password') }} </h2>
                <form class="p-3 w-50" autocomplete="off" action="{{ route('user.account.updatePassword') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="required"> {{ __('Current password') }} </label>
                        <input type="password" name="current_password" class="form-control">
                        <small class="text-danger">{{ $errors->first('current_password') }}</small>
                    </div>
                    <div class="form-group">
                        <label class="required"> {{ __('New password') }} </label>
                        <input type="password" name="new_password" class="form-control">
                        <small class="text-danger">{{ $errors->first('new_password') }}</small>
                    </div>
                    <div class="form-group">
                        <label class="required"> {{ __('Password confirmation') }} </label>
                        <input type="password" name="password_confirmation" class="form-control">
                        <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary"> {{ __('Submit') }} </button>
                        <a href="{{ route('user.account.show') }}" class="btn btn-secondary"> {{ __('Back') }} </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
