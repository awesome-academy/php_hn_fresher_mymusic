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
                                <textarea disabled rows="10" type="text" class="form-control" value="">{{ $album->description }}</textarea>
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
                    <a class="btn btn-primary mx-3" data-toggle="modal" data-target="#add-song-to-album">
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
                                    <th scope="col">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($album->songs as $key => $song)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{ $song->name}} </td>
                                    <td class="table-thumb">
                                        <img src="{{ asset($song->thumbnail) }}" alt="">
                                    </td>
                                    <td><span class="desc">{{ $song->description}}</span></td>
                                    <td>
                                        <a href="{{ route('admin.songs.show',$song->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.songs.edit',$song->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.albums.removeSong') }}" class="d-inline" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="song_id" value="{{ $song->id }}">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr><td colspan="6" class="text-center pt-3"> {{ __('no_data') }} </td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modal x-id="add-song-to-album" x-title="{{ __('add_music_to_album') }}" x-size="lg">
        <form action="{{ route('admin.albums.addSong') }}" method="post">
            @csrf
            @method('put')
            <div class="form-group col-lg-12">
                <label for="song-album"> {{ __('song_album') }} </label>
                <input type="hidden" value="{{ $album->id }}" name="album_id">
                <div class="c-select2">
                    <select class="song-album-select2 form-control" id="song-album" name="song_id[]" multiple="multiple" >
                        @foreach ($author->songs as $song)
                        @if ($song->album_id != $album->id)
                            <option value="{{ $song->id }}"> {{ $song->name }} </option>
                        @endif
                        @endforeach
                    </select>
                    <div class="pr-1"></div>
                    <a href="{{ route('admin.songs.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i></a>

                </div>
                <small class="text-danger"> {{ $errors->first('album_id') ?? '' }} </small>
            </div>
            <button class="btn btn-primary" type="submit">{{ __('submit') }}</button>
        </form>
    </x-modal>
@endsection
