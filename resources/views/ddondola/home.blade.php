@extends('layouts.base.ddondola-no-container')
@section('title')@parent Home @endsection
@section('home-active', 'active')
@section('main')
    {{--<div class="directory home">--}}
        {{--<div class="directory-list">--}}
            {{--<product-feed></product-feed>--}}
        {{--</div>--}}
        {{--<div class="directory-area p-4">--}}
            {{--<featured-products :count="4"></featured-products>--}}
            {{--<featured-shops :count="4"></featured-shops>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="container py-2">
        <div class="row">
            <div class="col-md-2">
                @include('ddondola.sections.shortcuts')
            </div>
            <div class="col-md-5 px-0">
                <product-feed></product-feed>
            </div>
            <div class="col-md-5">
                <featured-products></featured-products>
                <featured-shops></featured-shops>
            </div>
        </div>
    </div>
@endsection


{{--@extends('layouts.base.ddondola-no-container')--}}
{{--@section('title')@parent Home @endsection--}}
{{--@section('home-active', 'active')--}}
{{--@section('main')--}}
    {{--<div class="container py-2">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-2">--}}
                {{--@include('ddondola.sections.shortcuts')--}}
            {{--</div>--}}
            {{--<div class="col-md-5 px-1">--}}
                {{--<product-feed></product-feed>--}}
            {{--</div>--}}
            {{--<div class="col-md-5">--}}
                {{--<featured-products></featured-products>--}}
                {{--<featured-shops></featured-shops>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}
