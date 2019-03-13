@extends('ddondola.users.profile.base.account')
@section('title')@parent Profile @endsection
@section('profile-active', 'active')
@section('profile')
    <user-profile :user="{{ $user }}"></user-profile>
@endsection