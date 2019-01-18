@extends('ddondola.me.edit')
@section('title')@parent Settings @endsection
@section('settings-active') active @endsection
@section('profile')
    <div class="card card-small edit-user-details border">
        <div class="card-body p-0">
            <form action="#" class="py-4">
                <div class="form-row mx-4">
                    <div class="col mb-3">
                        <h6 class="form-text m-0">Notifications</h6>
                        <p class="form-text text-muted m-0">Setup which notifications would you like to receive.</p>
                    </div>
                </div>
                <div class="form-row mx-4">
                    <label for="conversationsEmailsToggle" class="col col-form-label"> Conversations
                        <small class="form-text text-muted"> Sends notification emails with updates for the
                            conversations you are participating in or if someone mentions you.
                        </small>
                    </label>
                    <div class="col d-flex">
                        <div class="custom-control custom-toggle ml-auto my-auto">
                            <input type="checkbox" id="conversationsEmailsToggle" class="custom-control-input"
                                   checked="">
                            <label class="custom-control-label" for="conversationsEmailsToggle"></label>
                        </div>
                    </div>
                </div>
                <div class="form-row mx-4">
                    <label for="newProjectsEmailsToggle" class="col col-form-label"> New Projects
                        <small class="form-text text-muted"> Sends notification emails when you are invited to a new
                            project.
                        </small>
                    </label>
                    <div class="col d-flex">
                        <div class="custom-control custom-toggle ml-auto my-auto">
                            <input type="checkbox" id="newProjectsEmailsToggle" class="custom-control-input">
                            <label class="custom-control-label" for="newProjectsEmailsToggle"></label>
                        </div>
                    </div>
                </div>
                <div class="form-row mx-4">
                    <label for="vulnerabilitiesEmailsToggle" class="col col-form-label"> Vulnerability Alerts
                        <small class="form-text text-muted"> Sends notification emails when everything goes down and
                            there's no hope left whatsoever.
                        </small>
                    </label>
                    <div class="col d-flex">
                        <div class="custom-control custom-toggle ml-auto my-auto">
                            <input type="checkbox" id="vulnerabilitiesEmailsToggle" class="custom-control-input"
                                   checked="">
                            <label class="custom-control-label" for="vulnerabilitiesEmailsToggle"></label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
