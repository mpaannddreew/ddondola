@extends('shoppie::shop.admin.base.admin')
@section('settings-active', 'active')
@section('header-navbar-class', 'border-bottom')
@section('tabs')
    <li class="nav-item">
        <a href="{{ route('my.shop.edit', ['shop' => $shop]) }}" class="nav-link @yield('info-active')">
            <i class="material-icons">mode_edit</i> Shop Info
        </a>
    </li>
@endsection