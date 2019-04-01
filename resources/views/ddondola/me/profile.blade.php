@extends('ddondola.me.base.profile-admin')
@section('title')@parent Profile @endsection
@section('profile-active', 'active')
@section('profile')
    <div class="row">
        <div class="col-md-4">
            <about></about>
        </div>
        <div class="col-md-6">
            <activities></activities>
        </div>
    </div>
@endsection
