@extends('layouts.admin')

@section('title', __('add_song'))

@section('songs', 'show')

@section('content')
    <div class="pagetitle">
        <h1> {{ __('add_song') }} </h1>
        <x-breadcrumb :items="['categories', 'add_song']"></x-breadcrumb>
    </div><!-- End Page Title -->

    <section class="section create-song-layout">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> {{ __('add_song') }} </h5>
                        <form action="{{ route('admin.songs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-lg-4">
                                    <label for="song-name" class="required"> {{ __('song_name') }} </label>
                                    <input type="text" name="name" id="song-name" class="form-control no-highlight"
                                        placeholder="{{ __('song_name') }}" value="{{ old('name') }}">
                                    <small class="text-danger"> {{ $errors->first('name') ?? '' }} </small>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="song-authors"> {{ __('song_authors') }} </label>
                                    <div class="c-select2">
                                        <select class="song-authors-select2 form-control" id="song-authors"
                                            name="author_id[]" multiple="multiple">
                                            @foreach ($authors as $author)
                                                <option value="{{ $author->id }}"> {{ $author->name }} </option>
                                            @endforeach
                                        </select>
                                        <div class="pr-1"></div>
                                        <x-modal-button x-id="create-new-author-in-song-component"
                                            :x-title="__('add_author')">
                                            <i class="bi bi-plus"></i>
                                        </x-modal-button>
                                    </div>
                                    <small class="text-danger"> {{ $errors->first('author_id') ?? '' }} </small>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="song-album"> {{ __('song_album') }} </label>
                                    <div class="c-select2">
                                        <select class="song-album-select2 form-control" id="song-album" name="album_id">
                                            <option value=""> {{ __('choose_author') }} </option>
                                        </select>
                                        <div class="pr-1"></div>
                                        <x-modal-button x-id="create-new-album-in-song-component"
                                            :x-title="__('add_album')">
                                            <i class="bi bi-plus"></i>
                                        </x-modal-button>
                                    </div>
                                    <small class="text-danger"> {{ $errors->first('album_id') ?? '' }} </small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="song-description" class="required"> {{ __('song_des') }} </label>
                                <textarea name="description" id="song-description" rows="5"
                                    class="form-control">{{ old('description') }}</textarea>
                                <small class="text-danger"> {{ $errors->first('description') ?? '' }} </small>
                            </div>
                            <div class="form-group">
                                <label for="song-path" class="required"> {{ __('song_path') }} </label>
                                <div class="d-flex">
                                    <input type="file" name="song" id="song-path" class="form-control-file"
                                        accept="audio/*">
                                    <audio src="" id="pre-listening" controls></audio>
                                    <input type="hidden" name="durations" id="durations">
                                </div>
                                <small class="text-danger"> {{ $errors->first('song') ?? '' }} </small>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12 position-relative">
                                    <label class="required"> {{ __('song_thumb') }} </label>
                                    <input type="file" name="thumbnail" id="thumbnail" class="song-input"
                                        accept="image/*">
                                    <div class="d-flex justify-content-center">
                                        <label for="avatar" class="open-thumbnail-input">
                                            <img src="{{ asset('assets/img/upload-img.png') }}" alt="upload image">
                                            <span class="d-inline-block pb-3">
                                                {{ __('song_thumb') }}
                                            </span>
                                        </label>
                                        <div class="song-thumbnail-preview ml-3"><img src="#"></div>
                                    </div>
                                    <small class="text-danger"> {{ $errors->first('thumbnail') ?? '' }} </small>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"> {{ __('submit') }} </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-modal x-id="create-new-author-in-song-component" x-title="{{ __('add_author') }}" x-size="lg">
        <form action="{{ route('admin.authors.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">{{ __('author_name') }}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="{{ __('author_name') }}" name="name">
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">{{ __('author_des') }}</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="10" placeholder="{{ __('author_des') }}" name="description"></textarea>
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">{{ __('author_thumb') }}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile" name="thumbnail">
                    <small class="text-danger">{{ $errors->first('thumbnail') }}</small>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">{{ __('submit') }}</button>
                </div>
            </div>
        </form>
    </x-modal>

    <x-modal x-id="create-new-album-in-song-component" x-title="{{ __('add_album') }}" x-size="lg">
        <form action="{{ route('admin.albums.store') }}" method="post">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">{{ __('album_title') }}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="{{ __('album_title') }}" name="title">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">{{ __('album_des') }}</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="10" placeholder="{{ __('album_des') }}" name="description"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">{{ __('author_name') }}</label>
                <div class="c-select2 col-sm-10">
                    <select id="authors-select" class="custom-select" name="author_id">
                        @forelse ($authors as $author)
                            <option value="{{ $author->id }}"> {{ $author->name }}</option>
                        @empty
                            <option value="">{{ __('no_data') }}</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">{{ __('submit') }}</button>
                </div>
            </div>
        </form>
    </x-modal>
@endsection
