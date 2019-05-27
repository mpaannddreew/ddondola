@extends('ddondola.me.base.profile-admin')
@section('title')@parent Followers @endsection
@section('followers-active', 'active')
@section('profile')
    <followers :me="{{ Auth::user() }}"></followers>
@endsection
