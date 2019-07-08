@extends('layouts.base.ddondola-no-container')
@section('title') {{ $user->name() }} - @endsection
@section('meta')
    <meta property="og:type" content="user"/>
    <meta property="og:title" content="{{ $user->name() }}"/>
    <meta property="og:description" content="{{ $user->profile('about') }}"/>
    <meta property="og:image" content="{{ $user->avatar()['url'] }}"/>
    <meta property="og:url" content="{{ route('user.profile', ['user' => $user]) }}" />
@endsection
@section('user-profile-bnr-class', '')
@section('main')
    @include('ddondola.sections.banner')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-3 px-1">
                @include('ddondola.sections.user-details', ['user' => $user])
            </div>
            <div class="col-md-6 px-1">
                @yield('profile')
            </div>
            <div class="col-md-3 px-1">

            </div>
        </div>
    </div>
@endsection
