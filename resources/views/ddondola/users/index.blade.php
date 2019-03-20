@extends('layouts.base.ddondola-no-container')
@section('title')@parent Users @endsection
@section('page-header')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle"><i class="fa fa-folder-open-o"></i> Directory</span>
            <h3 class="page-title">People</h3>
        </div>
    </div>
@endsection
@section('main')
    <div class="container py-4">
        <users type="users" url="{{ url("/") }}" :me="{{ Auth::user() }}"></users>
    </div>
@endsection
