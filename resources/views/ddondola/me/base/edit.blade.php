@extends('ddondola.me.base.account-admin')
@section('edit-active', 'active')
@section('page-header')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle"><i class="fa fa-user-circle"></i> Account</span>
            <h3 class="page-title">Update</h3>
        </div>
    </div>
@endsection
@section('header-navbar-class', 'border-bottom')
@section('tabs')
    <li class="nav-item">
        <a href="{{ route('my.profile.edit') }}" class="nav-link @yield('info-active')">
            <i class="material-icons">mode_edit</i> Profile Info
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('show.change.password') }}" class="nav-link @yield('password-active')">
            <i class="material-icons">lock</i> Change Password
        </a>
    </li>
@endsection