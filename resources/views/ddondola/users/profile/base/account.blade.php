@extends('layouts.base.ddondola-no-container')
@section('title') {{ $user->name() }} - @endsection
@section('user-profile-bnr-class', '')
@section('main')
    @include('ddondola.sections.banner')
    <div class="container py-4">
        @yield('profile')
    </div>
@endsection
