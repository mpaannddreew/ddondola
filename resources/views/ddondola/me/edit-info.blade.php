@extends('ddondola.me.edit')
@section('title')@parent General @endsection
@section('info-active', 'active')
@section('edit')
    <edit-user :user="{{ Auth::user() }}"></edit-user>
@endsection
