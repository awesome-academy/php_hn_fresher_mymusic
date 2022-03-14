@extends('layouts.admin')
@section('albums', 'show')
@section('title', __('edit_album'))
@section('content')
    <div class="pagetitle">
        <h1>{{ __('edit_album') }}</h1>
        <x-breadcrumb :items="['Album','edit_album']"> </x-breadcrumb>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('edit_album') }}</h5>
                        <form action="{{ route('admin.albums.update',$album->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label  class="col-sm-2 col-form-label">{{ __('album_title') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="{{ __('album_title') }}" name="title" value="{{ $album->title}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label  class="col-sm-2 col-form-label">{{ __('album_des') }}</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="10" placeholder="{{ __('album_des') }}" name="description"> {{ $album->description}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label  class="col-sm-2 col-form-label">{{ __('author_name') }}</label>
                                <div class="c-select2 col-sm-10">
                                    <select id="authors-select" class="custom-select" name="author_id">
                                        @forelse ($authors as $author )
                                            <option {{ $album->author_id == $author->id ? "selected" : ''}} value="{{ $author->id}}"> {{ $author->name}}</option>
                                        @empty
                                            <option value="">{{ __('no_data') }}</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">{{ __('submit')}}</button>
                                    <a href="{{ route('admin.albums.index')}}" class="btn btn-secondary">{{ __('back')}}</a>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
