@extends('ddondola.users.profile.base.account')
@section('title')@parent Profile @endsection
@section('profile-active', 'active')
@section('profile')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-small mb-4 border">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-4">
                        <strong class="d-block mb-2">Bio</strong>
                        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio eaque, quidem, commodi soluta qui quae minima obcaecati quod dolorum sint alias, possimus illum assumenda eligendi cumque?</span>
                    </li>
                </ul>
            </div>
            <div class="card card-small mb-4 border">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-4">
                        <strong class="d-block mb-2">Phone number</strong>
                        <span>+256785631375</span>
                    </li>
                </ul>
            </div>
            <div class="card card-small mb-4 border">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-4">
                        <strong class="d-block mb-2">Email</strong>
                        <span>andrewmvp007@gmail.com</span>
                    </li>
                </ul>
            </div>
            <div class="card card-small mb-4 border">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-4">
                        <strong class="d-block mb-2">Location</strong>
                        <span>Menlo Park, California, United States</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection