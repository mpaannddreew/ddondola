@extends('ddondola.users.profile.base.account')
@section('title')@parent Followers @endsection
@section('followers-active', 'active')
@section('profile')
    <users type="followers" :user="{{ $user }}" url="{{ url("/") }}" :me="{{ Auth::user() }}"></users>
@endsection