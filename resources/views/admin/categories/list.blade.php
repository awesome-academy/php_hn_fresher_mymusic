@extends('layouts.admin')

@section('title', __('list_categories'));

@section('categories', 'show');

@section('content')
    <div class="pagetitle">
        <h1> {{ __('list_categories') }} </h1>
        <x-breadcrumb :items="['categories', 'list_categories']"></x-breadcrumb>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> {{ __('list_categories') }} </h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"> {{ __('categories_name') }} </th>
                                    <th scope="col"> {{ __('categories_description') }} </th>
                                    <th scope="col"> {{ __('create_at') }} </th>
                                    <th scope="col"> {{ __('updated_at') }} </th>
                                    <th scope="col"> {{ __('action') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    {{-- <th scope="row">1</th>
                                    <td>Brandon Jacob</td>
                                    <td>Designer</td>
                                    <td>2016-05-25</td>
                                    <td>2016-05-25</td>
                                    <td>
                                        <a href="{{ route('admin.categories.show', ['category' => 1]) }}" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.categories.edit', ['category' => 1]) }}" class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.categories.destroy', ['category' => 1]) }}" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </td> --}}
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
