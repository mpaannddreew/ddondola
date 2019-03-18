@extends('ddondola.users.profile.base.account')
@section('title')@parent Following @endsection
@section('following-active', 'active')
@section('profile')
    <users type="following" :user="{{ $user }}" url="{{ url("/") }}" :me="{{ Auth::user() }}"></users>
@endsection