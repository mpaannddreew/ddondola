@extends('layouts.base.ddondola-profile-card')
@section('title')@parent Notifications @endsection
@section('page-content')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle">Activity</span>
            <h3 class="page-title">Notifications</h3>
        </div>
    </div>
    <notifications></notifications>
@endsection