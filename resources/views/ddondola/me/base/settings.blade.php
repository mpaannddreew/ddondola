@extends('ddondola.me.base.account-admin')
@section('user-profile-bnr-class', '')
@section('settings-active') active @endsection
@section('header-navbar-class', 'border-bottom')
@section('tabs')
    <li class="nav-item">
        <a href="{{ route('my.profile.edit') }}" class="nav-link @yield('info-active')">
            <i class="material-icons">mode_edit</i> Account Info
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('show.change.password') }}" class="nav-link @yield('password-active')">
            <i class="material-icons">lock</i> Change Password
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('my.notifications') }}" class="nav-link @yield('notifications-active')">
            <i class="material-icons">notifications_active</i> Notifications
        </a>
    </li>
@endsection
@section('main')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-8 offset-2">
                @yield('settings')
            </div>
        </div>
    </div>
@endsection

