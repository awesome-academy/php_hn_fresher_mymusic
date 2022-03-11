@extends('layouts.admin')
@section('authors', 'show')
@section('title', __('view_author'))
@section('content')
    <div class="pagetitle">
        <h1>{{ __('view_author') }}</h1>
        <x-breadcrumb :items="['Author','view_author']"> </x-breadcrumb>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('view_author') }}</h5>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('author_name') }}</label>
                            <div class="col-sm-10">
                                <input disabled type="text" class="form-control" placeholder="{{ __('author_name') }}"name="name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('author_des') }}</label>
                            <div class="col-sm-10">
                                <input disabled type="text" class="form-control" placeholder="{{ __('author_des') }}"name="description">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('author_thumb') }}</label>
                            <div class="col-sm-10 image-author">
                                <img src="{{ asset('bower_components/user_template/assets/img/music/song2.jpg') }}"alt="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <a href="{{ route('admin.authors.edit', ['author' => 1]) }}" class="btn btn-primary mr-2">{{ __('edit') }}</button>
                                <a href="{{ route('admin.authors.index') }}"class="btn btn-secondary">{{ __('back') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h4 class="p-3">{{ __('song_list_of_author') }}</h4>
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
                                {{-- <tr>
                                    <th scope="row">1</th>
                                    <td>Lạc Trôi </td>
                                    <td class="table-thumb">
                                        <img src="{{ asset('bower_components/user_template/assets/img/music/song2.jpg') }}" alt="">
                                    </td>
                                    <td>Description</td>
                                    <td>Album</td>
                                    <td>2016-05-25</td>
                                    <td>2016-05-25</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Lạc Trôi </td>
                                    <td class="table-thumb">
                                        <img src="{{ asset('bower_components/user_template/assets/img/music/song2.jpg') }}"alt="">
                                    </td>
                                    <td>Description</td>
                                    <td>Album</td>
                                    <td>2016-05-25</td>
                                    <td>2016-05-25</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
