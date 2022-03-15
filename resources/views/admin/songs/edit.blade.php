@extends('layouts.admin')

@section('title', __('edit_song'));

@section('songs', 'show');

@section('content')
    <div class="pagetitle">
        <h1> {{ __('edit_song') }} </h1>
        <x-breadcrumb :items="['categories', 'edit_song']"></x-breadcrumb>
    </div>

    <section class="section create-song-layout">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> {{ __('edit_song') }} </h5>
                        <form>
                            <div class="form-row">
                                <div class="form-group col-lg-4">
                                    <label for="song-name" class="required"> {{ __('song_name') }} </label>
                                    <input type="text" id="song-name" value="" class="form-control no-highlight" placeholder="{{ __('song_name') }}">
                                    <small class="text-danger"></small>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="song-authors"> {{ __('song_authors') }} </label>
                                    <div class="c-select2">
                                        <select class="song-authors-select2 form-control" id="song-authors" name="authors[]" multiple="multiple">
                                            {{-- Fake data --}}
                                            {{-- <option value="AL">Alabama</option>
                                            <option value="WY">Wyoming</option>
                                            <option value="WY">Wyoming 2</option>
                                            <option value="WY">Wyoming 3</option> --}}
                                        </select>
                                        <div class="pr-1"></div>
                                        <x-modal 
                                            x-id="create-new-author" 
                                            x-title="{{ __('add_author') }}"
                                            x-button='<i class="bi bi-plus"></i>'
                                            x-size="lg">
                                            <form action="{{ route('admin.authors.store') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row mb-3">
                                                    <label  class="col-sm-2 col-form-label">{{ __('author_name') }}</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" placeholder="{{ __('author_name') }}" name="name">
                                                        <small class="text-danger">{{ $errors->first('name') }}</small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label  class="col-sm-2 col-form-label">{{ __('author_des') }}</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" rows="10" placeholder="{{ __('author_des') }}" name="description"></textarea>
                                                        <small class="text-danger">{{ $errors->first('description') }}</small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label  class="col-sm-2 col-form-label">{{ __('author_thumb') }}</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control-file" type="file" id="formFile" name="thumbnail">
                                                        <small class="text-danger">{{ $errors->first('thumbnail') }}</small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-12">
                                                        <button type="submit" class="btn btn-primary">{{ __('submit')}}</button>
                                                        <a href="{{ route('admin.authors.index')}}" class="btn btn-secondary">{{ __('back')}}</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </div>
                                    <small class="text-danger"></small>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="song-album" class="required"> {{ __('song_album') }} </label>
                                    <div class="c-select2">
                                        <select class="song-album-select2 form-control" id="song-album" name="album_id">
                                            {{-- Fake data --}}
                                            {{-- <option value=""></option>
                                            <option value="AL">Alabama</option>
                                            <option value="ISO-8859-1">ISO-8859-1</option>
                                            <option value="cp1252">ANSI</option>
                                            <option value="utf8">UTF-8</option>
                                            <option value="WY">Wyoming</option> --}}
                                        </select>
                                        <div class="pr-1"></div>
                                        <x-modal 
                                            x-id="create-new-album" 
                                            x-title="{{ __('add_album') }}"
                                            x-button='<i class="bi bi-plus"></i>'
                                            x-size="lg">
                                            <form>
                                                <div class="row mb-3">
                                                    <label  class="col-sm-2 col-form-label"> {{ __('album_title') }} </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" placeholder="{{ __('album_title') }}" name="name">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label  class="col-sm-2 col-form-label"> {{ __('album_des') }} </label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" rows="10" placeholder="{{ __('album_des') }}" name="description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label  class="col-sm-2 col-form-label"> {{ __('author_name') }} </label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="{{ __('author_name') }}">
                                                        <datalist id="datalistOptions">
                                                            {{-- Fake data --}}
                                                            {{-- <option value="Author 01">
                                                            <option value="Author 02">
                                                            <option value="Author 03"> --}}
                                                        </datalist>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-12">
                                                        <button type="submit" class="btn btn-primary"> {{ __('submit')}} </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </div>
                                    <small class="text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="song-description" class="required"> {{ __('song_des') }} </label>
                                <textarea name="description" id="song-description" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label class="required"> {{ __('song_path') }} </label>
                                    <div class="d-flex">
                                        <input type="file" name="path" id="song-path" class="form-control-file" accept="audio/*">
                                        <audio src="" class="pre-listening" controls></audio>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12 position-relative">
                                    <label class="required"> {{ __('song_thumb') }} </label>
                                    <input type="file" id="thumbnail" class="song-input" accept="image/*">
                                    <div class="d-flex justify-content-center">
                                        <label for="avatar" class="open-thumbnail-input">
                                            <img src="{{ asset('assets/img/upload-img.png') }}" alt="upload image">
                                            <span class="d-inline-block pb-3">
                                                {{ __('song_thumb') }}
                                            </span>
                                        </label>
                                        <div class="song-thumbnail-preview ml-3"><img src="#"></div>
                                    </div>
                                    <small class="text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"> {{ __('edit') }} </button>
                                <a href="{{ route('admin.songs.show', ['song' => 1]) }}" class="btn btn-secondary">
                                    {{ __('back') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
