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
                                <input disabled type="text" class="form-control" value="{{ $album->title }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('album_des') }}</label>
                            <div class="col-sm-10">
                                <input disabled type="text" class="form-control" value="{{ $album->description }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('author_name') }}</label>
                            <div class="col-sm-10">
                                <input disabled type="text" class="form-control" value = "{{ $album->author->name}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <a href="{{ route('admin.albums.edit', $album->id ) }}" class="btn btn-primary mr-2">{{ __('edit') }}</button>
                                <a href="{{ route('admin.albums.index') }}"class="btn btn-secondary">{{ __('back') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h4 class="p-3">{{ __('song_list_of_album') }}</h4>
                    <a href="#" class="btn btn-primary">
                        <span> {{ __('add_music_to_album')}}</span>
                        <i class="fa-solid fa-music"></i>
                    </a>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('song_name') }}</th>
                                    <th scope="col">{{ __('song_thumb') }}</th>
                                    <th scope="col">{{ __('song_des') }}</th>
                                    <th scope="col">{{ __('created_at') }}</th>
                                    <th scope="col">{{ __('updated_at') }}</th>
                                    <th scope="col">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($album->songs as $key => $song)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{ $song->name}} </td>
                                    <td>{{ $song->thumbnail}}</td>
                                    <td>{{ $song->description}}</td>
                                    <td>{{ $song->created_at}}</td>
                                    <td>{{ $song->updated_at}}</td>
                                    <td><i class="fa-solid fa-folder-music"></i>
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
