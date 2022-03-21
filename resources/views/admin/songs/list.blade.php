@extends('layouts.admin')

@section('title', __('list_songs'))

@section('songs', 'show')

@section('content')
    <div class="pagetitle">
        <h1> {{ __('list_songs') }} </h1>
        <x-breadcrumb :items="['categories', 'list_songs']"></x-breadcrumb>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> {{ __('list_songs') }} </h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"> {{ __('song_name') }} </th>
                                    <th scope="col"> {{ __('song_thumb') }} </th>
                                    <th scope="col"> {{ __('song_album') }} </th>
                                    <th scope="col"> {{ __('song_authors') }} </th>
                                    <th scope="col"> {{ __('song_des') }} </th>
                                    <th scope="col"> {{ __('created_at') }} </th>
                                    <th scope="col"> {{ __('updated_at') }} </th>
                                    <th scope="col"> {{ __('action') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($songs as $index => $song)
                                    <tr>
                                        <th scope="row"> {{ $index + 1 }} </th>
                                        <td> {{ $song->name }} </td>
                                        <td><img class="song-thumbnail" src="{{ asset($song->thumbnail) }}"></td>
                                        <td> {{ $song->album->title ?? __('no_data') }} </td>
                                        <td>
                                            @if (count($song->authors) > 0)
                                                {{ implode(', ', $song->authors->pluck('name')->toArray()) }}
                                            @else
                                                {{ __('no_data') }}
                                            @endif
                                        </td>
                                        <td> {{ $song->description }} </td>
                                        <td> {{ $song->created_at }} </td>
                                        <td> {{ $song->updated_at }} </td>
                                        <td>
                                            <a href="{{ route('admin.songs.show', ['song' => $song->id]) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.songs.edit', ['song' => $song->id]) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.songs.destroy', ['song' => $song->id]) }}"
                                                class="d-inline" method="POST"
                                                onsubmit="return confirm('{{ __('confirm_delete') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9"> {{ __('no_data') }} </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $songs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
