@extends('shoppie::shop.admin.base.admin')
@section('title')@parent Settings @endsection
@section('settings-active', 'active')
@section('page-header')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle"><i class="fa fa-shopping-bag"></i> Shop</span>
            <h3 class="page-title">Update</h3>
        </div>
    </div>
@endsection
@section('header-navbar-class', 'border-bottom')
@section('tabs')
    @include('shoppie::shop.admin.sections.tabs')
@endsection