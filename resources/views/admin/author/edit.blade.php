@extends('layouts.admin')
@section('authors', 'show')
@section('title', __('edit_author'))
@section('content')
    <div class="pagetitle">
        <h1>{{ __('edit_author') }}</h1>
        <x-breadcrumb :items="['Author','edit_author']"> </x-breadcrumb>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('edit_author') }}</h5>
                        <form >
                            <div class="row mb-3">
                                <label  class="col-sm-2 col-form-label">{{ __('author_name') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="{{ __('author_name') }}" name="name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label  class="col-sm-2 col-form-label">{{ __('author_des') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="{{ __('author_des') }}" name="description">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label  class="col-sm-2 col-form-label">{{ __('author_thumb') }}</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="formFile" name="thumbnail">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">{{ __('submit')}}</button>
                                    <a href="{{ route('admin.authors.index')}}" class="btn btn-secondary">{{ __('back')}}</a>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
