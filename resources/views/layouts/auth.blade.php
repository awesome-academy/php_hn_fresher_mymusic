<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('seo')
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.svg') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title', env('APP_NAME'))</title>
    @stack('css')
</head>

<body>
    <div id="root">
        <div class="auth-header">
            <a href="{{ route('home') }}" class="d-flex justify-content-center align-items-center text-decoration-none">
                <div class="auth-logo">
                    <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo my music">
                </div>
                <h2 class="text-dark">MYMUSIC</h2>
            </a>
        </div>
        @yield('content')
    </div>

    <script>
        window.translations = {!! $translation !!};
        window.translationJsons = {!! $translationJson !!};
    </script>
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('bower_components/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
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
