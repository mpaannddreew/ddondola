@extends('layouts.base.ddondola-no-container')
@section('title')@parent People @endsection
@section('people-active', 'active')
@section('main')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-2">
                @include('ddondola.sections.shortcuts')
            </div>
            <div class="col-md-10 px-1">
                <people :me="{{ Auth::user() }}"></people>
            </div>
        </div>
    </div>
@endsection
