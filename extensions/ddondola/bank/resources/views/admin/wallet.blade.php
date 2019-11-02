@extends('ddondola.admin.base.admin')
@section('title')@parent Wallet @endsection
@section('wallet-active', 'active')
@section('user-profile-bnr-class', '')
@section('main')
    <wallet :holder="{{ $holder }}" :admin="true"></wallet>
@endsection