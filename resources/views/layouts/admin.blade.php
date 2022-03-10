<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
======================================================== -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.svg') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;500;600&display=swap">
    <link rel="stylesheet" href="{{ asset('bower_components/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin_template/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin_template/assets/vendor/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin_template/assets/vendor/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin_template/assets/vendor/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin_template/assets/vendor/remixicon/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin_template/assets/vendor/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin_template/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('head')
    <title>@yield('title', env('APP_NAME'))</title>
    @stack('css')
</head>

<body>
    <div id="root">
        @include('partials.admin.header')
        @include('partials.admin.sidebar')
        <main id="main" class="main">
            @yield('content')
        </main>
        @include('partials.admin.footer')
    </div>

    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin_template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bower_components/fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('bower_components/toast/dist/toast.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin_template/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin_template/assets/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin_template/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin_template/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin_template/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('bower_components/admin_template/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin_template/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('bower_components/admin_template/assets/js/main.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('js')

</body>

</html>
