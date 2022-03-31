@extends('layouts.admin')

@section('title')
    {{ __('dashboard') }}
@endsection

@section('content')
    <div class="pagetitle">
        <h1> {{ __('dashboard') }} </h1>
        <x-breadcrumb :items="[]"></x-breadcrumb>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-3">
                    <div class="d-flex justify-content-between">
                        <h5> {{ __('song_chart') }} </h5>
                        <select id="song-chart-filter" name="state">
                        </select>
                    </div>
                    <canvas id="song-chart"> {{ __('canva_not_supported') }} </canvas>
                </div>
            </div>
        </div>
    </section>
@endsection
