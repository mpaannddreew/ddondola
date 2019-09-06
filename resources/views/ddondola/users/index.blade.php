@extends('base')
@section('title')@parent People @endsection
@section('people-active', 'active')
@section('body-class') class="h-100" @endsection
@section('container', '')
@section('main')
    <div class="container py-2">
        <people></people>
    </div>
@endsection
