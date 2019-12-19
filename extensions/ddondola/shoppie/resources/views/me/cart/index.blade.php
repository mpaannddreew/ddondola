@extends('ddondola.me.base.account-admin-icon-side-nav')
@section('cart-active', 'active')
@section('title')@parent Cart @endsection
@section('body-class') class="h-100 bg-white" @endsection
@section('page-header')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle"><i class="fa fa-shopping-bag"></i> Shopping</span>
            <h3 class="page-title">Cart</h3>
        </div>
    </div>
@endsection
@section('main')
    <div class="card card-small border-radius-0" style="background: unset !important;">
        <div class="card-header border-radius-0 profile-header" style="height: 92px !important;">
        </div>
        <div class="card-body p-0 profile-body bg-white border-top">
            <div class="container py-2" style="position: relative; top: -95px !important;">
                <router-view></router-view>
            </div>
        </div>
    </div>
@endsection
