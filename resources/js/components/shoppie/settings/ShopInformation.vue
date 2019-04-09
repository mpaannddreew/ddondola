<template>
    <div>
        <div class="card mb-2">
            <div class="card-header form-wizard-step border-right border-top border-top-right-radius-0">
                <h5>
                    <a class="btn btn-link" href="javascript:void(0)">
                        <span>01</span><i class="material-icons">shop</i> General Information
                    </a>
                </h5>
            </div>
            <div class="card-body p-4 border border-top-0">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <div class="input-group input-group-seamless">
                            <span class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">shop</i>
                              </span>
                            </span>
                            <input type="text" class="form-control" id="name" placeholder="Name">
                        </div>
                        <div class="invalid-feedback" id="name_feedback"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone_number">Phone Number</label>
                        <div class="input-group input-group-seamless">
                                <span class="input-group-prepend">
                                  <span class="input-group-text">
                                    <i class="material-icons">phone</i>
                                  </span>
                                </span>
                            <input type="text" class="form-control" id="phone_number" placeholder="PhoneNumber">
                        </div>
                        <div class="invalid-feedback" id="phone_number_feedback"></div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="emailAddress">Email Address</label>
                        <div class="input-group input-group-seamless">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="material-icons">email</i>
                                </div>
                            </div>
                            <input type="email" class="form-control" id="emailAddress" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="biography">About Shop</label>
                        <textarea class="form-control" id="biography" placeholder="About Shop"></textarea>
                        <div class="invalid-feedback" id="biography_feedback"></div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" placeholder="Address"></textarea>
                        <div class="invalid-feedback" id="address_feedback"></div>
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
        name: "ShopInformation",
        data() {
            return {
                loading: false,
            }
        }
    }
</script>

<style scoped>

</style>