@extends('layouts.auth')

@section('title', __('Edit profile'))

@section('content')
    <div class="row no-gutters account-container">
        @include('user.account.sidebar')
        <div class="col-10 account-content">
            <div class="card d-flex flex-column align-items-center">
                <h2 class="mb-0 p-3"> {{ __('Edit profile') }} </h2>
                <form class="p-3 w-50" action="{{ route('user.account.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="required"> {{ __("What your's first name?") }} </label>
                        <input type="text" class="form-control" name="first_name" value="{{ auth()->user()->first_name }}">
                        <small class="text-danger">{{ $errors->first('first_name') }}</small>
                    </div>
                    <div class="form-group">
                        <label class="required"> {{ __("What your's last name?") }} </label>
                        <input type="text" class="form-control" name="last_name" value="{{ auth()->user()->last_name }}">
                        <small class="text-danger">{{ $errors->first('last_name') }}</small>
                    </div>
                    <div class="form-group">
                        <label class="required"> {{ __('Avatar') }} </label>
                        <input type="file" class="form-control-file" name="avatar">
                        <small class="text-danger">{{ $errors->first('avatar') }}</small>
                        <img src="{{ asset(auth()->user()->avatar) }}">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary"> {{ __('Edit') }} </button>
                        <a href="{{ route('user.account.show') }}" class="btn btn-secondary"> {{ __('Back') }} </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
