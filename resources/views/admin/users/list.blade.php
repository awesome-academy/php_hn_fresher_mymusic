@extends('layouts.admin')

@section('title', __('manage_users'))

@section('content')
    <div class="pagetitle">
        <h1> {{ __('manage_users') }} </h1>
        <x-breadcrumb :items="['manage_users']"></x-breadcrumb>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> {{ __('manage_users') }} </h5>
                        <table class="admin-user-table table">
                            <thead>
                                <tr>
                                    <th scope="col" class="center">#</th>
                                    <th scope="col" class="center"> {{ __('user_fullname') }} </th>
                                    <th scope="col" class="center"> {{ __('Email') }} </th>
                                    <th scope="col" class="center"> {{ __('role') }} </th>
                                    <th scope="col" class="center"> {{ __('created_at') }} </th>
                                    <th scope="col" class="center"> {{ __('updated_at') }} </th>
                                    <th scope="col" class="center"> {{ __('active') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $key => $user)
                                    <tr>
                                        <td class="center"> {{ $key + 1 }} </td>
                                        <td class="center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="admin-user-avatar">
                                                    <img src="{{ $user->avatar_full_path }}">
                                                </span>
                                                <span class="d-inline-block ml-3"> {{ $user->full_name }} </span>
                                            </div>
                                        </td>
                                        <td class="center"> {{ $user->email }} </td>
                                        <td class="center"> {{ $user->getRoleDescriptionAttribute() }} </td>
                                        <td class="center"> {{ $user->created_at }} </td>
                                        <td class="center"> {{ $user->updated_at }} </td>
                                        <td class="center">
                                            <form class="d-inline-block">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox"
                                                            class="user-manage custom-control-input user-select-none cursor-pointer"
                                                            id="active-user-{{ $user->id }}" data-user-id="{{ $user->id }}"
                                                            {{ $user->isActive() ? 'checked' : '' }}>
                                                        <label class="custom-control-label user-select-none cursor-pointer"
                                                            for="active-user-{{ $user->id }}">
                                                        </label>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7"> {{ __('no_data') }} </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
