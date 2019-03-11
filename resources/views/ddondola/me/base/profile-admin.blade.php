@extends('ddondola.me.base.account-admin')
@section('profile-base-active') active @endsection
@section('user-profile-bnr-class', '')
@section('main')
    @include('ddondola.sections.banner')
    <div class="container py-4">
        @yield('profile')
    </div>
@endsection
