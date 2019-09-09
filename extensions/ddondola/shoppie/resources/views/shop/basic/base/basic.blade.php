@extends('layouts.base.ddondola')
@section('title'){{ $shop->name }} - @endsection
@section('meta')
    <meta property="og:type" content="shop"/>
    <meta property="og:title" content="{{ $shop->name }}"/>
    <meta property="og:description" content="{{ $shop->profile('description') }}"/>
    <meta property="og:image" content="{{ $shop->avatar()['url'] }}"/>
    <meta property="og:url" content="{{ route('shop', ['shop' => $shop]) }}" />
@endsection
@section('user-profile-bnr-class', '')
@section('main')
    @include('shoppie::shop.sections.banner')
    @yield('shop-profile')
@endsection