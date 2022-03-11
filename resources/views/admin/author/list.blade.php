@extends('layouts.admin')
@section('authors', 'show')
@section('title', __('List Author'))
@section('content')
    <div class="pagetitle">
        <h1>{{ __('List Author') }}</h1>
        <x-breadcrumb :items="['Author','List Author']"> </x-breadcrumb>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('author_name')}}</th>
                                    <th scope="col">{{ __('author_des')}}</th>
                                    <th scope="col">{{ __('author_thumb')}}</th>
                                    <th scope="col">{{ __('created_at')}}</th>
                                    <th scope="col">{{ __('updated_at')}}</th>
                                    <th scope="col">{{ __('action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <th scope="row">1</th>
                                    <td>Son Tung Mtp</td>
                                    <td>Description</td>
                                    <td class="table-thumb">
                                        <img src="{{ asset('bower_components/user_template/assets/img/music/song2.jpg') }}"alt="">
                                    </td>
                                    <td>2016-05-25</td>
                                    <td>2016-05-25</td>
                                    <td>
                                        <a href="{{ route('admin.authors.show', ['author' => 1]) }}" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.authors.edit', ['author' => 1]) }}" class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.authors.destroy', ['author' => 1]) }}" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Son Tung Mtp</td>
                                    <td>Description</td>
                                    <td class="table-thumb">
                                        <img src="{{ asset('bower_components/user_template/assets/img/music/song2.jpg') }}"alt="">
                                    </td>
                                    <td>2016-05-25</td>
                                    <td>2016-05-25</td>
                                    <td>
                                        <a href="{{ route('admin.authors.show', ['author' => 1]) }}" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.authors.edit', ['author' => 1]) }}" class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.authors.destroy', ['author' => 1]) }}" class="btn btn-sm btn-danger">
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
