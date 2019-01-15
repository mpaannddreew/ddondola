@extends('ddondola.me.base.profile-admin')
@section('title')@parent Edit @endsection
@section('edit-active') active @endsection
@section('profile-info')
    <ul class="edit-menu m-4">
        <li class="@yield('info-active')">
            <i class="icon ion-ios-information-outline"></i>
            <a href="{{ route('my.profile.edit') }}">Basic Information</a>
        </li>
        <li class="@yield('settings-active')">
            <i class="icon ion-ios-settings"></i>
            <a href="{{ route('my.profile.edit.settings') }}"> Settings</a>
        </li>
    </ul>
@endsection
