@extends('ddondola.me.base.account-admin')
@section('title')@parent Messenger @endsection
@section('user-profile-bnr-class', '')
@section('messenger-active', 'active')
@section('main')
    <messenger home-url="/me/messenger" :owner-id="{{ Auth::user()->id }}" owner-type="user"></messenger>
@endsection