@extends('layouts.auth')

@section('title')
    {{ __('unverified_title') }}
@endsection

@section('content')
<div class="container-fluid my-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <h5 class="text-center">
                {{ __('unverified_description') }}
                <form action="{{ route('verification.resend') }}" class="d-inline" method="POST">
                    @csrf
                    <button class="btn btn-link p-0 resend-email-btn"> {{ __('unverified_here') }} </button>
                </form>
            </h5>
        </div>
    </div>
</div>
@endsection
