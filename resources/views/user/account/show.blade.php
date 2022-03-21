@extends('layouts.auth')

@section('title', __('Profile'))

@section('content')
    <div class="row no-gutters account-container">
        @include('user.account.sidebar')
        <div class="col-10 account-content">
            <div class="card d-flex flex-column align-items-center">
                <h2 class="mb-0 p-3"> {{ __('Profile') }} </h2>
                <form class="p-3 w-50">
                    <div class="form-group">
                        <label for=""> {{ __('user_fullname') }} </label>
                        <input type="text" class="form-control" value="{{ auth()->user()->full_name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for=""> {{ __('Email') }} </label>
                        <input type="text" class="form-control" value="{{ auth()->user()->email }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for=""> {{ __('Avatar') }} </label>
                        <img src="{{ asset(auth()->user()->avatar) }}">
                    </div>
                    <div class="form-group">
                        <a href="{{ route('user.account.edit') }}" class="btn btn-primary"> {{ __('Edit') }} </a>
                        <a href="{{ route('home') }}" class="btn btn-secondary"> {{ __('Exit') }} </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
