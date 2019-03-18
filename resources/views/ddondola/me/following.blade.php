@extends('ddondola.me.base.profile-admin')
@section('title')@parent Following @endsection
@section('following-active', 'active')
@section('profile')
    <users type="myFollowing" url="{{ url("/") }}" :me="{{ Auth::user() }}"></users>
@endsection
