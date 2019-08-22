@extends('layouts.base.ddondola-no-container')
@section('title') {{ $user->name() }} - @endsection
@section('stylesheets')
    @parent
    <style>
        ul#profile.nav.nav-tabs.nav-justified.border-0.flex-column.flex-lg-row li.nav-item a.nav-link {
            margin: 0 !important;
        }

        ul#profile.nav.nav-tabs.nav-justified.border-0.flex-column.flex-lg-row  li.nav-item {
            border-right:1px solid #e1e5eb !important;
        }

        ul#profile.nav.nav-tabs.nav-justified.border-0.flex-column.flex-lg-row  li.nav-item:last-child {
            border-right: none !important;
        }
    </style>
@endsection
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
