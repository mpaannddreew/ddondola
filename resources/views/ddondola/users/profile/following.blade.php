@extends('ddondola.users.profile.base.account')
@section('title')@parent Following @endsection
@section('following-active', 'active')
@section('profile')
    <following :user="{{ $user }}" @auth :me="{{ auth()->user() }}" @endauth></following>
@endsection