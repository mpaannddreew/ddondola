@extends('ddondola.me.base.profile-admin')
@section('title')@parent Profile @endsection
@section('profile-active', 'active')
@section('profile')
    <feed :admin="true"></feed>
@endsection
