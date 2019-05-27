@extends('ddondola.users.profile.base.account')
@section('title')@parent Profile @endsection
@section('profile-active', 'active')
@section('profile')
    <feed :user="{{ $user }}"></feed>
@endsection