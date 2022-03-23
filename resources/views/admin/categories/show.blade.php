@extends('layouts.admin')

@section('title', __('show_category'))

@section('categories', 'show')

@section('content')
    <div class="pagetitle">
        <h1> {{ __('show_category') }} </h1>
        <x-breadcrumb :items="['categories', 'show_category']"></x-breadcrumb>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ __('show_category') }}
                            <mark> {{ $category->name }} </mark>
                        </h5>
                        <form>
                            <div class="form-group">
                                <label for="inputText" class="required"> {{ __('categories_name') }} </label>
                                <input type="text" class="form-control" placeholder="{{ __('categories_name') }}"
                                    value="{{ $category->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="required"> {{ __('categories_description') }}
                                </label>
                                <textarea class="form-control" rows="10"
                                    disabled>{{ $category->description }} </textarea>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('admin.categories.edit', ['category' => request()->route('category')]) }}"
                                    class="btn btn-primary"> {{ __('edit') }} </a>
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                                    {{ __('back') }} </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <h4 class="p-3">{{ __('song_list_of_category') }}</h4>
                    <a class="btn btn-primary mx-3" data-toggle="modal" data-target="#add-song-to-category">
                        <span> {{ __('add_music_to_category')}}</span>

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
                                    <th scope="col">{{ __('album') }}</th>
                                    <th scope="col">{{ __('created_at') }}</th>
                                    <th scope="col">{{ __('updated_at') }}</th>
                                    <th scope="col">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($category->songs as $index => $song)
                                    <tr>
                                        <th scope="row"> {{ $index + 1 }} </th>
                                        <td>{{ $song->name }} </td>
                                        <td class="table-thumb">
                                            <img src="{{ asset($song->thumbnail) }}" alt="">
                                        </td>
                                        <td>{{ $song->description }}</td>
                                        <td>@if($song->album){{ $song->album->title }} @endif</td>
                                        <td>{{ $song->created_at }}</td>
                                        <td>{{ $song->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.songs.show',$song->id) }}" class="btn btn-sm btn-primary mb-1">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.songs.edit',$song->id) }}" class="btn btn-sm btn-warning mb-1">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.categories.removeSong') }}" class="d-inline mb-1" method="post">
                                                @csrf
                                                <input type="hidden" name="song_id" value="{{ $song->id }}">
                                                <input type="hidden" name="category_id" value="{{ $category->id }}">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center pt-3"> {{ __('no_data') }} </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modal x-id="add-song-to-category" x-title="{{ __('add_music_to_category') }}" x-size="lg">
        <form action="{{ route('admin.categories.addSong') }}" method="post">
            @csrf
            <div class="form-group col-lg-12">
                <label for="song-album"> {{ __('song_category') }} </label>
                <input type="hidden" value="{{ $category->id }}" name="category_id">
                <div class="c-select2">
                    <select class="song-album-select2 form-control" id="song-album" name="song_id[]" multiple="multiple" >
                        @foreach ($songs as $song)
                            @if($song->categories )
                                {{-- <option value="{{ $song->id }}"> {{ $song->name }} </option> --}}
                                <option value="{{ $song->id }}"> {{ $song->name }} </option>
                            @endif
                        @endforeach
                    </select>
                    <div class="pr-1"></div>
                    <a href="{{ route('admin.songs.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i></a>

                </div>
                <small class="text-danger"> {{ $errors->first('album_id') ?? '' }} </small>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </x-modal>
@endsection
