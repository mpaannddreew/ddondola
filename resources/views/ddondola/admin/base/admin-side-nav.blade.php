@extends('layouts.base.admin')
@section('title') Admin - @endsection
@section('name') Ddondola Admin @endsection
@section('nav-wrapper')
    <h6 class="main-sidebar__nav-title">Dashboards</h6>
    <ul class="nav nav--no-borders flex-column">
        <li class="nav-item">
            <a class="nav-link @yield('dashboard-active')" href="{{ route('admin.dashboard') }}">
                <i class="material-icons">dashboard</i>
                <span>Dashboard</span>
            </a>
        </li>
    </ul>
    <h6 class="main-sidebar__nav-title">Directories</h6>
    <ul class="nav nav--no-borders flex-column">
        <li class="nav-item">
            <a class="nav-link @yield('people-active')" href="{{ route('admin.users') }}">
                <i class="material-icons">people</i>
                <span>Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('categories-active')" href="{{ route('admin.categories') }}">
                <i class="material-icons">work</i>
                <span>Categories</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('shops-active')" href="{{ route('admin.shops') }}">
                <i class="material-icons">shop_two</i>
                <span>Shops</span>
            </a>
        </li>
    </ul>
    <h6 class="main-sidebar__nav-title">Financial</h6>
    <ul class="nav nav--no-borders flex-column">
        <li class="nav-item">
            <a class="nav-link @yield('feedback-active')" href="#">
                <i class="material-icons">credit_card</i>
                <span>Payments</span>
            </a>
        </li>
    </ul>
    <h6 class="main-sidebar__nav-title">Communication</h6>
    <ul class="nav nav--no-borders flex-column">
        <li class="nav-item">
            <a class="nav-link @yield('feedback-active')" href="#">
                <i class="material-icons">feedback</i>
                <span>Feedback</span>
            </a>
        </li>
    </ul>
    <h6 class="main-sidebar__nav-title">Configuration</h6>
    <ul class="nav nav--no-borders flex-column">
        <li class="nav-item">
            <a class="nav-link @yield('settings-active')" href="#">
                <i class="material-icons">settings</i>
                <span>Settings</span>
            </a>
        </li>
    </ul>
@endsection
