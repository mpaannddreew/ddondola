@extends('ddondola.me.base.profile-admin')
@section('title')@parent Following @endsection
@section('following-active', 'active')
@section('profile')
    <following :me="{{ Auth::user() }}"></following>
@endsection
