@extends('layouts.admin')

@section('title', __('list_categories'))

@section('categories', 'show')

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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"> {{ __('categories_name') }} </th>
                                    <th scope="col"> {{ __('categories_description') }} </th>
                                    <th scope="col"> {{ __('created_at') }} </th>
                                    <th scope="col"> {{ __('updated_at') }} </th>
                                    <th scope="col"> {{ __('action') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $index => $category)
                                    <tr>
                                        <th scope="row"> {{ $index + 1 }} </th>
                                        <td> {{ $category->name }} </td>
                                        <td> {{ $category->description }} </td>
                                        <td> {{ $category->created_at }} </td>
                                        <td> {{ $category->updated_at }} </td>
                                        <td>
                                            <a href="{{ route('admin.categories.show', ['category' => $category->id]) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                            <form
                                                action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}"
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
                                        <td colspan="6" class="text-center py-3"> {{ __('no_data') }} </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
