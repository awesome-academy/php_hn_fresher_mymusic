@extends('layouts.admin')
@section('authors', 'show')
@section('title', __('list_authors'))
@section('content')
    <div class="pagetitle">
        <h1>{{ __('list_authors') }}</h1>
        <x-breadcrumb :items="['Author','list_authors']"> </x-breadcrumb>
    </div>
    <section class="section">
        <button class="mb-3 btn btn-primary" data-toggle="modal" data-target="#import-excel">{{ __('import_excel') }}</button>
        <x-modal x-id="import-excel" x-title="{{ __('import_excel') }}" x-size="md">
            <form action="{{ route('admin.authors.importExcel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="author_file">{{ __( 'choose_excel') }}</label>
                    <input id="author_file" type="file" name="author_file" class="hidden" accept=".xlsx, .xls, .csv, .ods" required>
                </div>
                <div class="form-row text-center">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">{{ __('submit') }}</button>
                    </div>
                 </div>
            </form>
        </x-modal>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('author_name') }}</th>
                                    <th scope="col">{{ __('author_des') }}</th>
                                    <th scope="col">{{ __('author_thumb') }}</th>
                                    <th scope="col">{{ __('created_at') }}</th>
                                    <th scope="col">{{ __('updated_at') }}</th>
                                    <th scope="col">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($authors as $key => $author)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $author->name }}</td>
                                    <td title="{{ $author->description }}">
                                        <span class="desc">{{ $author->description}}</span>
                                    </td>
                                    <td class="table-thumb">
                                        <img src="{{ asset($author->thumbnail)}}"alt="">
                                    </td>
                                    <td>{{ $author->created_at}}</td>
                                    <td>{{ $author->updated_at}}</td>
                                    <td>
                                        <a href="{{ route('admin.authors.show',['author' => $author->id]) }}" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.authors.edit',['author' => $author->id]) }}" class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <form class="d-inline" id="deleteForm" action="{{ route('admin.authors.destroy',$author->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr><td colspan="8" class="text-center pt-3"> {{ __('no_data') }} </td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $authors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
