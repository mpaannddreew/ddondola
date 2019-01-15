@extends('ddondola.users.profile.base.account')
@section('title')@parent Profile @endsection
@section('profile-active') active @endsection
@section('profile')
    <div class="row">
        <div class="col-md-8">
            <profile-tabs></profile-tabs>
        </div>
        <div class="col-md-4">

        </div>
    </div>
@endsection