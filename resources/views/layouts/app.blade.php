<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <meta name="robots" content="index, follow" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@section('title'){{ config('app.name', 'Ddondola') }} - @show</title>

    <!-- Stylesheets
    ================================================= -->
    <link rel="stylesheet" href="{{ asset('css/material-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/extras.1.2.0.min.css') }}"/>
    @yield('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}"/>

    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/fav.png') }}"/>
</head>
<body @yield('body-class') @yield('body-id')>

@yield('app')

<!-- Scripts
================================================= -->
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('js/libs/popper.js/1.14.3/umd/popper.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/libs/Chart.js/2.7.1/Chart.min.js') }}"></script>
<script src="{{ asset('js/theme.min.js') }}"></script>
<script src="{{ asset('js/libs/Sharrre/2.0.1/jquery.sharrre.min.js') }}"></script>
<script src="{{ asset('js/extras.min.js') }}"></script>
<script src="{{ asset('js/theme-extra.min.js') }}"></script>
@yield('javascripts')
<script src="{{ asset('js/app.js') }}" defer></script>
@yield('scripts')
</body>
</html>
