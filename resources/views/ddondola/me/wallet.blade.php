@extends('ddondola.me.base.account-admin')
@section('title')@parent Wallet @endsection
@section('user-profile-bnr-class', '')
@section('wallet-active', 'active')
@section('main')
    <wallet :holder="{{ auth()->user() }}"></wallet>
@endsection