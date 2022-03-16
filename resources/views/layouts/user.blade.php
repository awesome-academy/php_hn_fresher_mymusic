<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('seo')
    <link rel="shortcut icon" href="{{ asset('assets/img/common/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/slick-carousel/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/user_template/assets/css/style.css') }}">
    <title>@yield('title', env('APP_NAME'))</title>
    @stack('css')
</head>

<body>
    <div id="root">
        <div class="row no-gutters">
            <x-sidebar></x-sidebar>
            <x-main>
                @include('user.homepage')
            </x-main>
            <x-music-player></x-music-player>
            <x-comment-box></x-comment-box>
        </div>
        <audio class="d-none" controls preload="metadata" id="music-player">
            <source src="" id="music-player-source">
        </audio>
    </div>

    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('bower_components/slick-carousel/slick/slick.min.js') }}"></script>
    <script src="{{ asset('bower_components/user_template/assets/js/main.js') }}"></script>
    <script src="{{ asset('bower_components/user_template/assets/js/eventHandle.js') }}"></script>
    <script src="{{ asset('bower_components/user_template/assets/js/slick.js') }}"></script>
    <script src="{{ asset('js/user/app.js') }}"></script>
    @stack('js')
</body>

</html>
