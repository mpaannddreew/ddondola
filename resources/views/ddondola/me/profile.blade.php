@extends('ddondola.me.base.profile-admin')
@section('title')@parent Profile @endsection
@section('profile-active', 'active')
@section('profile')
    <div class="row">
        <div class="col-md-3 px-1">
            <about :user="{{ Auth::user() }}"></about>
        </div>
        <div class="col-md-6 px-1">
            <feed></feed>
        </div>
        <div class="col-md-3 px-1">
            @include('shoppie::shop.sections.shop-card')
        </div>
    </div>
@endsection
