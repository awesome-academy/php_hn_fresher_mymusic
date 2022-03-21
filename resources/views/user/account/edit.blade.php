@extends('layouts.auth')

@section('title', __('Edit profile'))

@section('content')
    <div class="row no-gutters account-container">
        @include('user.account.sidebar')
        <div class="col-10 account-content">
            <div class="card d-flex flex-column align-items-center">
                <h2 class="mb-0 p-3"> {{ __('Edit profile') }} </h2>
                <form class="p-3 w-50">
                    <div class="form-group">
                        <label class="required"> {{ __('user_fullname') }} </label>
                        <input type="text" class="form-control" value="{{ auth()->user()->full_name }}">
                    </div>
                    <div class="form-group">
                        <label class="required"> {{ __('Email') }} </label>
                        <input type="text" class="form-control" value="{{ auth()->user()->email }}">
                    </div>
                    <div class="form-group">
                        <label class="required"> {{ __('Avatar') }} </label>
                        <input type="file" class="form-control-file">
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
