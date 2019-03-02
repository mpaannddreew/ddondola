@extends('ddondola.me.base.profile-admin')
@section('edit-active', 'active')
@section('profile-info')
    <ul class="edit-menu m-4">
        <li class="@yield('info-active')">
            <i class="icon ion-ios-information-outline"></i>
            <a href="{{ route('my.profile.edit') }}">General</a>
        </li>
        <li class="@yield('settings-active')">
            <i class="icon ion-ios-settings"></i>
            <a href="{{ route('my.profile.edit.settings') }}">Settings</a>
        </li>
    </ul>
@endsection
