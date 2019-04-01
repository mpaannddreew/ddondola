@extends('ddondola.me.base.profile-admin')
@section('banner')@endsection
@section('edit-active', 'active')
@section('profile')
    <div class="row">
        <div class="col-md-3">
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
        </div>
        <div class="col-md-9">
            @yield('edit')
        </div>
    </div>
@endsection
