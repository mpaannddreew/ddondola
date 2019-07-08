<template>
    <div>
        <div class="card border border-radius mb-2">
            <div class="card-body p-4">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="old_password">Old Password</label>
                        <div class="input-group input-group-seamless">
                                <span class="input-group-prepend">
                                  <span class="input-group-text">
                                    <i class="material-icons">lock</i>
                                  </span>
                                </span>
                            <input type="text" class="form-control" id="old_password" placeholder="Old Password">
                        </div>
                        <div class="invalid-feedback" id="old_password_feedback"></div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="new_password">New Password</label>
                        <div class="input-group input-group-seamless">
                                <span class="input-group-prepend">
                                  <span class="input-group-text">
                                    <i class="material-icons">lock</i>
                                  </span>
                                </span>
                            <input type="text" class="form-control" id="new_password" placeholder="New Password">
                        </div>
                        <div class="invalid-feedback" id="new_password_feedback"></div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="password_confirmation">Repeat New Password</label>
                        <div class="input-group input-group-seamless">
                                <span class="input-group-prepend">
                                  <span class="input-group-text">
                                    <i class="material-icons">lock</i>
                                  </span>
                                </span>
                            <input type="email" class="form-control" id="password_confirmation" placeholder="Repeat New Password">
                        </div>
                        <div class="invalid-feedback" id="password_confirmation_feedback"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-wizard-buttons text-md-right">
            <button type="button" class="btn btn-lg btn-pill btn-outline-primary" :class="{disabled: loading}" @click="validate">
                <i class="material-icons">check</i> Save
            </button>
            <button class="btn btn-link p-0" v-show="loading"><div class="loader loader-sm"></div></button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ChangePassword",
        data() {
            return {
                loading: false,
            }
        }
    }
</script>

<style scoped>

</style>