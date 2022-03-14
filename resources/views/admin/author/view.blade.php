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
                                <input disabled type="text" class="form-control" value="{{$author->name}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('author_des') }}</label>
                            <div class="col-sm-10">
                                <input disabled type="text" class="form-control" value="{{$author->description}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('author_thumb') }}</label>
                            <div class="col-sm-10 image-author">
                                <img src="{{ asset($author->thumbnail) }}"alt="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <a href="{{ route('admin.authors.edit', ['author' => $author->id]) }}" class="btn btn-primary mr-2">{{ __('edit') }}</button>
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
                                @forelse ($author->songs as $key => $song)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $song->name}} </td>
                                    <td class="table-thumb">
                                        <img src="{{ asset($song->thumbnail) }}" alt="">
                                    </td>
                                    <td>{{ $song->description}}</td>
                                    <td>{{ $song->album}}</td>
                                    <td>{{ $song->created_at}}</td>
                                    <td>{{ $song->updated_at}}</td>
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
                                @empty
                                    <tr><td colspan="8" class="text-center pt-3"> {{ __('no_data') }} </td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <h4 class="p-3">{{ __('album_list_of_author') }}</h4>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('album_title') }}</th>
                                    <th scope="col">{{ __('album_description') }}</th>
                                    <th scope="col">{{ __('created_at') }}</th>
                                    <th scope="col">{{ __('updated_at') }}</th>
                                    <th scope="col">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($author->albums as $key => $album)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{ $album->title}} </td>
                                    <td>{{ $album->description}}</td>
                                    <td>{{ $album->created_at}}</td>
                                    <td>{{ $album->updated_at}}</td>
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
                                @empty
                                    <tr><td colspan="8" class="text-center pt-3"> {{ __('no_data') }} </td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
