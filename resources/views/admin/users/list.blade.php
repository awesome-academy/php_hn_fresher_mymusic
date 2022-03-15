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
                                {{-- Fake data --}}
                                {{-- <tr>
                                    <td class="center">1</td>
                                    <td class="center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="admin-user-avatar">
                                                <img src="{{ asset('assets/img/default-avatar.png') }}">
                                            </span>
                                            <span class="d-inline-block ml-3">Nguyen Manh Thang</span>
                                        </div>
                                    </td>
                                    <td class="center">admin@sun.com</td>
                                    <td class="center">Admin</td>
                                    <td class="center">2022-03-09 10:44:33</td>
                                    <td class="center">2022-03-09 10:44:33</td>
                                    <td class="center">
                                        <form class="d-inline-block">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input user-select-none cursor-pointer" id="active-user-2">
                                                    <label class="custom-control-label user-select-none cursor-pointer" for="active-user-2"></label>
                                                </div>
                                            </div>
                                        </form>
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
