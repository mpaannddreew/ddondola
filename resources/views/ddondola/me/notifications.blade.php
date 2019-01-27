@extends('layouts.base.ddondola-profile-card')
@section('title')@parent Notifications @endsection
@section('right-side')
    <div class="col-md-9 mb-4">
        <div class="page-header row no-gutters mb-4">
            <div class="col">
                <span class="text-uppercase page-subtitle">Activity</span>
                <h3 class="page-title">Notifications</h3>
            </div>
        </div>
        <notifications></notifications>
    </div>
@endsection