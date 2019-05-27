@extends('ddondola.me.base.account-admin')
@section('profile-base-active') active @endsection
@section('user-profile-bnr-class', '')
@section('main')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-3 px-1">
                @include('ddondola.sections.user-details', ['user' => Auth::user()])
            </div>
            <div class="col-md-6 px-1">
                @include('ddondola.sections.banner')
                @yield('profile')
            </div>
            <div class="col-md-3 px-1">
                @include('shoppie::shop.sections.shop-card')
            </div>
        </div>
    </div>
@endsection
