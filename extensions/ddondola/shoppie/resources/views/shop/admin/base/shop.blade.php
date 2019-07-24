@extends('shoppie::shop.admin.base.admin')
@section('profile-base-active') active @endsection
@section('user-profile-bnr-class', '')
@section('main')
    @include('shoppie::shop.sections.banner')
    @yield('shop-profile')
@endsection

