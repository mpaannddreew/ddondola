@extends('layouts.in')
@section('container-fluid')
    <main class="main-content col-lg-12 col-md-12 col-sm-12 p-0">
        @include('layouts.sections.ddondola.navbar')
        @yield('custom-design')
        @include('layouts.sections.ddondola.header-navbar')
        <div class="main-content-container @section('container') container @show">
            @yield('main')
        </div>
        @include('layouts.sections.footer')
    </main>
@endsection