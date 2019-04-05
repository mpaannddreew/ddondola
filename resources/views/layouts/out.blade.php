@extends('layouts.app')
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
@endsection

@section('app')
    @yield('lp-register')
@endsection

@section('javascripts')
    @yield('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endsection

