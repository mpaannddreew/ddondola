@extends('ddondola.me.base.account-admin')
@section('title')@parent Settings @endsection
@section('settings-active', 'active')
@section('page-header')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle"><i class="fa fa-user-circle"></i> Account</span>
            <h3 class="page-title">Settings</h3>
        </div>
    </div>
@endsection
@section('main')
    <account-settings></account-settings>
@endsection
