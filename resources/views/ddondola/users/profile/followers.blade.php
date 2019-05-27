@extends('ddondola.users.profile.base.account')
@section('title')@parent Followers @endsection
@section('followers-active', 'active')
@section('profile')
    <followers :user="{{ $user }}" @auth :me="{{ Auth::user() }}" @else :auth="false" @endauth></followers>
@endsection