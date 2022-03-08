<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('seo')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>@yield('title', env('APP_NAME'))</title>
    @stack('css')
</head>

<body>
    <div id="root">
        <div class="auth-header">
            <div class="d-flex justify-content-center align-items-center">
                <div class="auth-logo">
                    <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo my music">
                </div>
                <h2>MYMUSIC</h2>
            </div>
        </div>
        @yield('content')
    </div>

    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('bower_components/toast/dist/toast.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('js')

</body>

</html>
