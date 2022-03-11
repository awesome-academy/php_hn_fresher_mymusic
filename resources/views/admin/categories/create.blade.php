@extends('layouts.admin')

@section('title', __('add_category'));

@section('categories', 'show');

@section('content')
    <div class="pagetitle">
        <h1> {{ __('add_category') }} </h1>
        <x-breadcrumb :items="['categories', 'add_category']"></x-breadcrumb>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> {{ __('add_category') }} </h5>
                        <form>
                            <div class="form-group">
                                <label for="inputText" class="required"> {{ __('categories_name') }} </label>
                                <input type="text" class="form-control" placeholder="{{ __('categories_name') }}">
                                <small class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="required"> {{ __('categories_description') }} </label>
                                <textarea class="form-control" rows="10"></textarea>
                                <small class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"> {{ __('submit') }} </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
