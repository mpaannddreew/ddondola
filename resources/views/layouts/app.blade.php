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
<script src="{{ asset('jquery-slimscroll/jquery.slimscroll.js') }}"></script>
@yield('javascripts')
<script src="{{ asset('js/app.js') }}" defer></script>
@yield('scripts')
</body>
</html>
