@extends('ddondola.me.edit')
@section('title')@parent Settings @endsection
@section('settings-active') active @endsection
@section('profile')
    <div class="edit-profile-container card border p-4">
        <div class="block-title">
            <h4 class="grey"><i class="icon ion-ios-settings"></i>Account Settings</h4>
            <div class="line"></div>
            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate</p>
            <div class="line"></div>
        </div>
        <div class="edit-block">
            <div class="settings-block">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="switch-description">
                            <div><strong>Enable follow me</strong></div>
                            <p>Enable this if you want people to follow you</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="toggle-switch">
                            <label class="switch">
                                <input type="checkbox" checked="">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="line"></div>
            <div class="settings-block">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="switch-description">
                            <div><strong>Send me notifications</strong></div>
                            <p>Send me notification emails my friends like, share or message me</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="toggle-switch">
                            <label class="switch">
                                <input type="checkbox" checked="">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="line"></div>
            <div class="settings-block">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="switch-description">
                            <div><strong>Text messages</strong></div>
                            <p>Send me messages to my cell phone</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="toggle-switch">
                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="line"></div>
            <div class="settings-block">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="switch-description">
                            <div><strong>Enable tagging</strong></div>
                            <p>Enable my friends to tag me on their posts</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="toggle-switch">
                            <label class="switch">
                                <input type="checkbox" checked="">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="line"></div>
            <div class="settings-block">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="switch-description">
                            <div><strong>Enable sound</strong></div>
                            <p>You'll hear notification sound when someone sends you a private message</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="toggle-switch">
                            <label class="switch">
                                <input type="checkbox" checked="">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
