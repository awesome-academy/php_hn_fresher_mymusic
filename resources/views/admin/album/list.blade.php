@extends('layouts.admin')
@section('albums', 'show')
@section('title', __('list_album'))
@section('content')
    <div class="pagetitle">
        <h1>{{ __('list_album') }}</h1>
        <x-breadcrumb :items="['Album','list_album']"> </x-breadcrumb>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('album_title')}}</th>
                                    <th scope="col">{{ __('album_des')}}</th>
                                    <th scope="col">{{ __('author_name')}}</th>
                                    <th scope="col">{{ __('created_at')}}</th>
                                    <th scope="col">{{ __('updated_at')}}</th>
                                    <th scope="col">{{ __('action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($albums as $key => $album )
                                    <tr>
                                        <th scope="row">{{ $key+1 }}</th>
                                        <td>{{ $album->title}}</td>
                                        <td title="{{ $album->description }}">
                                            <span class="desc">{{ $album->description}}</span>
                                        </td>
                                        <td>{{ $album->author->name}}</td>
                                        <td>{{ $album->created_at}}</td>
                                        <td>{{ $album->updated_at}}</td>
                                        <td>
                                            <a href="{{ route('admin.albums.show',$album->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.albums.edit', $album->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                            <form class="d-inline" id="deleteForm" action="{{ route('admin.albums.destroy',$album->id) }}"
                                                onsubmit="return confirm('{{ __('confirm_delete') }}')" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-3"> {{ __('no_data') }} </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $albums->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
