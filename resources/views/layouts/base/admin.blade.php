@extends('layouts.in')
@section('container-fluid')
    <!-- Main Sidebar -->
    @include('layouts.sections.admin.aside')
    <!-- End Main Sidebar -->
    <main class="main-content @section('main-class') col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3 @show">
        @include('layouts.sections.admin.navbar')
        <alert></alert>
        <div class="main-content-container container-fluid px-4" style="padding: 0 !important; overflow-x: hidden;">
            @yield('main')
        </div>
        {{--@include('layouts.sections.footer')--}}
    </main>
@endsection