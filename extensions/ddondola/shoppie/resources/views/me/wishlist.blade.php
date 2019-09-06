@extends('ddondola.me.base.account-admin-icon-side-nav')
@section('title')@parent Wishlist @endsection
@section('wishlist-active', 'active')
{{--@section('page-header')--}}
    {{--<div class="page-header row no-gutters py-4">--}}
        {{--<div class="col">--}}
            {{--<span class="text-uppercase page-subtitle"><i class="fa fa-shopping-bag"></i> Shopping</span>--}}
            {{--<h3 class="page-title">Wishlist</h3>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}
@section('main')
    <wish-list></wish-list>
@endsection