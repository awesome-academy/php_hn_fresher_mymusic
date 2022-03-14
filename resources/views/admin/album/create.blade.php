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
                        <form>
                            <div class="row mb-3">
                                <label  class="col-sm-2 col-form-label">{{ __('album_title') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="{{ __('album_title') }}" name="name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label  class="col-sm-2 col-form-label">{{ __('album_des') }}</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="10" placeholder="{{ __('album_des') }}" name="description"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label  class="col-sm-2 col-form-label">{{ __('author_name') }}</label>
                                <div class="col-sm-10">
                                    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="{{ __('author_name') }}">
                                    <datalist id="datalistOptions">
                                        <option value="Author 01">
                                        <option value="Author 02">
                                        <option value="Author 03">
                                    </datalist>
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
