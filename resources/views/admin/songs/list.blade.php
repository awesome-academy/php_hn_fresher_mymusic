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
                        <table class="table datatable">
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
                                {{-- Fake data --}}
                                {{-- <tr>
                                    <th scope="row">1</th>
                                    <td>Brandon Jacob</td>
                                    <td>Designer</td>
                                    <td>2016-05-25</td>
                                    <td>2016-05-25</td>
                                    <td>2016-05-25</td>
                                    <td>2016-05-25</td>
                                    <td>2016-05-25</td>
                                    <td>
                                        <a href="{{ route('admin.songs.show', ['song' => 1]) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.songs.edit', ['song' => 1]) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.songs.destroy', ['song' => 1]) }}"
                                            class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
