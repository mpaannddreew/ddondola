@extends('ddondola.me.base.profile-admin')
@section('title')@parent Notifications @endsection
@section('banner')@endsection
@section('notifications-active', 'active')
@section('profile')
    <div class="row">
        <div class="col-md-4">
            <about></about>
        </div>
        <div class="col-md-8">
            <notifications></notifications>
        </div>
    </div>
@endsection