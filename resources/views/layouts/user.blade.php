<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('seo')
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/slick-carousel/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/user_template/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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

    <script>
        window.translations = {!! $translation !!};
        window.translationJsons = {!! $translationJson !!};
    </script>
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('bower_components/slick-carousel/slick/slick.min.js') }}"></script>
    <script src="{{ asset('bower_components/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/user/app.js') }}"></script>
    @if (Session::has('success'))
        <script>
            toastr.success("{{ session('success') }}")
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            toastr.error("{{ session('error') }}")
        </script>
    @endif
    @stack('js')
</body>

</html>
