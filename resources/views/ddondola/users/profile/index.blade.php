@extends('ddondola.users.profile.base.account')
@section('title')@parent Profile @endsection
@section('profile-active', 'active')
@section('profile')
    <div class="row">
        <div class="col-md-3 px-2">
            <about :user="{{ $user }}"></about>
        </div>
        <div class="col-md-6 px-2">
            <feed :actor="{{ $user }}"></feed>
        </div>
        <div class="col-md-3 px-2">
            @include('shoppie::shop.sections.shop-card')
        </div>
    </div>
@endsection