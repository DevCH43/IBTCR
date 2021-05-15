<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <base href="../" />

    <title>{{ config('app.name')  }}</title>

    <!-- include common vendor stylesheets & fontawesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('node_modules/bootstrap/dist/css/bootstrap.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('node_modules/@fortawesome/fontawesome-free/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('node_modules/@fortawesome/fontawesome-free/css/regular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('node_modules/@fortawesome/fontawesome-free/css/brands.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('node_modules/@fortawesome/fontawesome-free/css/solid.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/ace-font.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/ace.css') }}">

    <link rel="icon" type="image/png" href="{{ asset('asset/favicon.png') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('views/pages/page-login/@page-style.css') }}">
</head>

<body>
<div class="body-container">
    @auth()
        @include('layouts.partials.navbar')
        <div class="main-container bgc-white">
        @include('layouts.partials.side-bar')
            <div class="main-content ">
                <div class="page-content m-1 ">
                    @yield('contenedor')
                    @include('layouts.partials.footer')
                </div>
            </div>
        </div>
    @else
        @yield('contenedor')
    @endauth
</div>

<!-- include common vendor scripts used in demo pages -->
<script src="{{ asset('node_modules/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('node_modules/popper.js/dist/umd/popper.js') }}"></script>
<script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.js') }}"></script>

<script src="{{ asset('dist/js/ace.js') }}"></script>

<script src="{{ asset('app/browser/demo.js') }}"></script>

<script src="{{ asset('views/pages/page-login/@page-script.js') }}"></script>
</body>
</html>
