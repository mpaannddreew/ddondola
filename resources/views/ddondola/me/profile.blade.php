@extends('ddondola.me.base.profile-admin')
@section('title')@parent Profile @endsection
@section('profile-active', 'active')
@section('profile')
    <user-profile :user="{{ $user }}"></user-profile>
@endsection
