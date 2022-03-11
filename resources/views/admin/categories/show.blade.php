@extends('layouts.admin')

@section('title', __('show_category'));

@section('categories', 'show');

@section('content')
    <div class="pagetitle">
        <h1> {{ __('show_category') }} </h1>
        <x-breadcrumb :items="['categories', 'show_category']"></x-breadcrumb>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ __('show_category') }}
                            {{-- <mark>V-Pop hahahehe</mark> --}}
                        </h5>
                        <form>
                            <div class="form-group">
                                <label for="inputText" class="required"> {{ __('categories_name') }} </label>
                                <input type="text" class="form-control" placeholder="{{ __('categories_name') }}" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="required"> {{ __('categories_description') }} </label>
                                <textarea class="form-control" rows="10" disabled>
                                    {{-- V-Pop hahahehe --}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('admin.categories.edit', ['category' => request()->route('category')]) }}" class="btn btn-primary"> {{ __('edit') }} </a>
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary"> {{ __('back') }} </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
