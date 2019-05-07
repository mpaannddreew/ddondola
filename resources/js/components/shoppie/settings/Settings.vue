<template>
    <div>
        <div class="card mb-2">
            <div class="card-header form-wizard-step border-right border-top border-top-right-radius-0">
                <h5>
                    <a class="btn btn-link" href="javascript:void(0)">
                        <span><i class="material-icons">more_vert</i></span>
                        <i class="material-icons">perm_data_setting</i> Settings
                    </a>
                </h5>
            </div>
            <div class="card-body p-4 border border-top-0">
                <div class="form-row">
                    <label for="conversationsEmailsToggle" class="col col-form-label"> Conversations <small class="form-text text-muted"> Sends notification emails with updates for the conversations you are participating in or if someone mentions you. </small>
                    </label>
                    <div class="col d-flex">
                        <div class="custom-control custom-toggle ml-auto my-auto">
                            <input type="checkbox" id="conversationsEmailsToggle" class="custom-control-input" checked="">
                            <label class="custom-control-label" for="conversationsEmailsToggle"></label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <label for="newProjectsEmailsToggle" class="col col-form-label"> New Projects <small class="form-text text-muted"> Sends notification emails when you are invited to a new project. </small>
                    </label>
                    <div class="col d-flex">
                        <div class="custom-control custom-toggle ml-auto my-auto">
                            <input type="checkbox" id="newProjectsEmailsToggle" class="custom-control-input">
                            <label class="custom-control-label" for="newProjectsEmailsToggle"></label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <label for="vulnerabilitiesEmailsToggle" class="col col-form-label"> Vulnerability Alerts <small class="form-text text-muted"> Sends notification emails when everything goes down and there's no hope left whatsoever. </small>
                    </label>
                    <div class="col d-flex">
                        <div class="custom-control custom-toggle ml-auto my-auto">
                            <input type="checkbox" id="vulnerabilitiesEmailsToggle" class="custom-control-input" checked="">
                            <label class="custom-control-label" for="vulnerabilitiesEmailsToggle"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Settings"
    }
</script>

<style scoped>

</style>