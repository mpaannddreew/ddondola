@extends('ddondola.me.base.profile-admin')
@section('title')@parent Followers @endsection
@section('followers-active', 'active')
@section('profile')
    <users type="myFollowers" url="{{ url("/") }}" :me="{{ Auth::user() }}"></users>
@endsection
