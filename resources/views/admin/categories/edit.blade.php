@extends('layouts.admin')

@section('title', __('edit_category'));

@section('categories', 'show');

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
                        <h5 class="card-title">
                            {{ __('edit_category') }}
                            {{-- <mark>V-Pop hahahehe</mark> --}}
                        </h5>
                        <form>
                            <div class="form-group">
                                <label for="inputText" class="required"> {{ __('categories_name') }} </label>
                                <input type="text" class="form-control" placeholder="{{ __('categories_name') }}" value="">
                                <small class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="required"> {{ __('categories_description') }} </label>
                                <textarea class="form-control" rows="10">
                                    {{-- V-Pop hahahehe --}}
                                </textarea>
                                <small class="text-danger"></small>
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
