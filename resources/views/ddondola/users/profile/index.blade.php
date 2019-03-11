@extends('ddondola.users.profile.base.account')
@section('title')@parent Profile @endsection
@section('profile-active', 'active')
@section('profile')
    <div class="row">
        <div class="col-md-3">
            <user-info></user-info>
            <shop-suggestions class="my-4"></shop-suggestions>
        </div>
        <div class="col-md-6">
            <about></about>
        </div>
        <div class="col-md-3">

        </div>
    </div>
@endsection