@extends('layouts.base.ddondola-profile-card')
@section('title')@parent Home @endsection
@section('page-content')
    <feed feed-type="news" :admin="true"></feed>
@endsection
