@extends('layouts.auth')

@section('title',__('Forgot Your Password'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h4 class="text-center pt-5">{{__('Forgot Your Password')}}</h4>
                <form id="forgot-form" action="/login" method="post">
                    <p>{{__('Send Email')}}</p>
                    <div class="form-group required">
                        <label class="font-weight-bold" for="email">{{__('Email address')}}</label>
                        <input placeholder="Email address" type="email" class="form-control email" id="email" name="email">
                        <small class="text-danger"></small>
                    </div>
                    <div class="form-group pt-1">
                        <button class="btn btn-custom d-block m-auto" type="submit">
                            <span>{{__('SENT')}}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
