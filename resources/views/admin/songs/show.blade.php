@extends('layouts.admin')

@section('title', __('show_song'))

@section('songs', 'show')

@section('content')
    <div class="pagetitle">
        <h1> {{ __('show_song') }} </h1>
        <x-breadcrumb :items="['categories', __('show_song')]"></x-breadcrumb>
    </div><!-- End Page Title -->

    <section class="section create-song-layout">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> {{ __('show_song') }} </h5>
                        <form>
                            <div class="form-row">
                                <div class="form-group col-lg-4">
                                    <label for="song-name" class="required"> {{ __('song_name') }} </label>
                                    <input type="text" name="name" id="song-name" class="form-control no-highlight"
                                        placeholder="{{ __('song_name') }}" value="{{ $song->name }}" disabled>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="song-authors"> {{ __('song_authors') }} </label>
                                    @if (count($song->authors) > 0)
                                        <input type="text" class="form-control"
                                            value="{{ implode(', ', $song->authors->pluck('name')->toArray()) }}" disabled>
                                    @else
                                        <input type="text" class="form-control" value="{{ __('no_data') }}" disabled>
                                    @endif
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="song-album"> {{ __('song_album') }} </label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ $song->album->title ?? __('no_data') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="song-description" class="required"> {{ __('song_des') }} </label>
                                <textarea name="description" id="song-description" rows="5" disabled
                                    class="form-control">{{ $song->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="song-path" class="required"> {{ __('song_path') }} </label>
                                <audio src="{{ asset($song->path) }}" class="d-block w-100" controls></audio>
                            </div>
                            <div class="form-group">
                                <label class="required"> {{ __('song_thumb') }} </label>
                                <div class="edit-song-thumbnail-preview show-blade">
                                    <img src="{{ asset($song->thumbnail) }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('admin.songs.edit', ['song' => $song->id]) }}" class="btn btn-primary">
                                    {{ __('edit') }}
                                </a>
                                <a href="{{ route('admin.songs.index') }}" class="btn btn-secondary">
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
