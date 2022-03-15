@extends('layouts.admin')

@section('title', __('edit_category'))

@section('categories', 'show')

@section('content')
    <div class="pagetitle">
        <h1> {{ __('edit_category') }} </h1>
        <x-breadcrumb :items="['categories', 'edit_category']"></x-breadcrumb>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> {{ __('edit_category') }} <mark> {{ $category->name }} </mark> </h5>
                        <form action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="inputText" class="required"> {{ __('categories_name') }} </label>
                                <input type="text" name="name" class="form-control" placeholder="{{ __('categories_name') }}" value="{{ $category->name }}">
                                <small class="text-danger"> {{ $errors->first('name') ?? '' }} </small>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="required"> {{ __('categories_description') }} </label>
                                <textarea class="form-control" name="description" rows="10">{{ $category->description }}</textarea>
                                <small class="text-danger"> {{ $errors->first('description') ?? '' }} </small>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"> {{ __('submit') }} </button>
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary"> {{ __('back') }} </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
