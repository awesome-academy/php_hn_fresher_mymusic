@extends('layouts.admin')
@section('albums', 'show')
@section('title', __('view_album'))
@section('content')
    <div class="pagetitle">
        <h1>{{ __('view_album') }}</h1>
        <x-breadcrumb :items="['Album','view_album']"> </x-breadcrumb>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('view_album') }}</h5>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('album_title') }}</label>
                            <div class="col-sm-10">
                                <input disabled type="text" class="form-control" placeholder="{{ __('album_title') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('album_des') }}</label>
                            <div class="col-sm-10">
                                <input disabled type="text" class="form-control" placeholder="{{ __('album_des') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('author_name') }}</label>
                            <div class="col-sm-10">
                                <input disabled type="text" class="form-control" placeholder="{{ __('author_name') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <a href="{{ route('admin.albums.edit', ['album' => 1]) }}" class="btn btn-primary mr-2">{{ __('edit') }}</button>
                                <a href="{{ route('admin.albums.index') }}"class="btn btn-secondary">{{ __('back') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h4 class="p-3">{{ __('song_list_of_album') }}</h4>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('song_name') }}</th>
                                    <th scope="col">{{ __('song_thumb') }}</th>
                                    <th scope="col">{{ __('song_des') }}</th>
                                    <th scope="col">{{ __('album') }}</th>
                                    <th scope="col">{{ __('created_at') }}</th>
                                    <th scope="col">{{ __('updated_at') }}</th>
                                    <th scope="col">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
