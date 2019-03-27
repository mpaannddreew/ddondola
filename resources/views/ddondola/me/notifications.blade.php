@extends('ddondola.me.base.account-admin-icon-side-nav')
@section('title')@parent Notifications @endsection
@section('notifications-active', 'active')
@section('page-header')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle"><i class="fa fa-feed"></i> Activity</span>
            <h3 class="page-title">Notifications</h3>
        </div>
    </div>
@endsection
@section('main')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-8 offset-2">
                <notifications></notifications>
            </div>
        </div>
    </div>
@endsection