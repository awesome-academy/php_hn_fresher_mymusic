@extends('layouts.admin')

@section('title', __('show_song'));

@section('songs', 'show');

@section('content')
    <div class="pagetitle">
        <h1> {{ __('show_song') }} </h1>
        <x-breadcrumb :items="['categories', 'show_song']"></x-breadcrumb>
    </div>

    <section class="section create-song-layout">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> {{ __('show_song') }} </h5>
                        <form>
                            <div class="form-row">
                                <div class="form-group col-lg-4">
                                    <label class="required"> {{ __('song_name') }} </label>
                                    <input type="text" class="form-control no-highlight" value="" readonly>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label> {{ __('song_authors') }} </label>
                                    <input type="text" class="form-control no-highlight" value="" readonly>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label class="required"> {{ __('song_album') }} </label>
                                    <input type="text" class="form-control no-highlight" value="" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="required"> {{ __('song_des') }} </label>
                                <textarea rows="5" class="form-control" readonly></textarea>
                            </div>
                            <div class="form-group">
                                <label for="song-path" class="required"> {{ __('song_path') }} </label>
                                <div class="d-flex">
                                    <audio src="" class="pre-listening w-100" controls></audio>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12 position-relative">
                                    <label class="required"> {{ __('song_thumb') }} </label>
                                    <div class="d-flex justify-content-center">
                                        <div class="song-thumbnail-preview ml-3">
                                            <img src="{{ asset('assets/img/default-avatar.png') }}">
                                        </div>
                                    </div>
                                    <small class="text-danger">{{ $errors->first('avatar') ?? '' }}</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('admin.songs.edit', ['song' => 1]) }}" class="btn btn-primary">
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
