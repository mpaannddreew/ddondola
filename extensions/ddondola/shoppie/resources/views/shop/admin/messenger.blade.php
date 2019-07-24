@extends('shoppie::shop.admin.base.admin')
@section('title')@parent Messenger @endsection
@section('messenger-active', 'active')
@section('main')
    <messenger home-url="/shops/{{ $shop->code }}/messenger" owner-id="{{ $shop->id }}" owner-type="shop"></messenger>
@endsection