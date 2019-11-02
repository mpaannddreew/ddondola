@extends('ddondola.admin.base.admin')
@section('title')@parent Escrow @endsection
@section('escrow-active', 'active')
@section('user-profile-bnr-class', '')
@section('main')
    <wallet :holder="{{ $holder }}" :escrow="true"></wallet>
@endsection