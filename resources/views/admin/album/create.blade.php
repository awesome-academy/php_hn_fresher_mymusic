@extends('layouts.admin')
@section('albums', 'show')
@section('title', __('add_album'))
@section('content')
    <div class="pagetitle">
        <h1>{{ __('add_album') }}</h1>
        <x-breadcrumb :items="['Album','add_album']"> </x-breadcrumb>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('add_album') }}</h5>
                        <form action="{{ route('admin.albums.store') }}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label  class="col-sm-2 col-form-label">{{ __('album_title') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="{{ __('album_title') }}" name="title">
                                    <small class="text-danger"> {{ $errors->first('title') ?? '' }} </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label  class="col-sm-2 col-form-label">{{ __('album_des') }}</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="10" placeholder="{{ __('album_des') }}" name="description"></textarea>
                                    <small class="text-danger"> {{ $errors->first('description') ?? '' }} </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label  class="col-sm-2 col-form-label">{{ __('author_name') }}</label>
                                <div class="c-select2 col-sm-10">
                                    <select id="authors-select" class="custom-select" name="author_id">
                                        @forelse ($authors as $author )
                                            <option value="{{ $author->id}}"> {{ $author->name}}</option>
                                        @empty
                                            <option value="">{{ __('no_data') }}</option>
                                        @endforelse
                                    </select>
                                    <small class="text-danger"> {{ $errors->first('author_id') ?? '' }} </small>
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
