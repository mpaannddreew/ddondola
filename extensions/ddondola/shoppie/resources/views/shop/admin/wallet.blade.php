@extends('shoppie::shop.admin.base.admin')
@section('title')@parent Wallet @endsection
@section('user-profile-bnr-class', '')
@section('wallet-active', 'active')
@section('main')
    <wallet :holder="{{ $shop }}" holder-type="shop"></wallet>
@endsection