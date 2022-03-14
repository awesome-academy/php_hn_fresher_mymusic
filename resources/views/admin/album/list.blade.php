@extends('layouts.admin')
@section('albums', 'show')
@section('title', __('list_album'))
@section('content')
    <div class="pagetitle">
        <h1>{{ __('list_album') }}</h1>
        <x-breadcrumb :items="['Album','list_album']"> </x-breadcrumb>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('album_title')}}</th>
                                    <th scope="col">{{ __('album_des')}}</th>
                                    <th scope="col">{{ __('author_name')}}</th>
                                    <th scope="col">{{ __('created_at')}}</th>
                                    <th scope="col">{{ __('updated_at')}}</th>
                                    <th scope="col">{{ __('action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="{{ route('admin.albums.show', ['album' => 1]) }}" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.albums.edit', ['album' => 1]) }}" class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.albums.destroy', ['album' => 1]) }}" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
