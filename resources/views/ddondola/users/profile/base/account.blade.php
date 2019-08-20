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
    @include('ddondola.sections.user')
@endsection
