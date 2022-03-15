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
                                        <td>{{ $song->album }}</td>
                                        <td>{{ $song->created_at }}</td>
                                        <td>{{ $song->updated_at }}</td>
                                        <td>
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
@endsection
