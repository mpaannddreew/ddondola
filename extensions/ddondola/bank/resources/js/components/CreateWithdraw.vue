<template>
    <div class="directory-area">
        <div class="card card-small h-100 main">
            <div class="card-body h-100 p-0 bg-white">
                <div class="card card-small border-radius-0 h-100" style="background: unset !important;">
                    <div class="card-header border-radius-0 profile-header" style="height: 120px !important;">
                    </div>
                    <div class="card-body p-4 profile-body bg-white border-top h-100">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div style="position: relative; top: -119px !important;">
                                    <header class="justify-content-between align-items-start mb-2">
                                        <div class="ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0">
                                            <a class="btn btn-white btn-sm text-danger" href="javascript:void(0)" @click="back">
                                                <i class="fa fa-chevron-left"></i> Back
                                            </a>
                                        </div>
                                    </header>
                                    <div class="card card-small border">
                                        <div class="card-header border-bottom">
                                            Withdraw Request
                                        </div>
                                        <div class="card-body">
                                            <div class="p-4">
                                                <div class="input-group border-0">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text border-0 text-primary">
                                                            <i class="material-icons">dialpad</i>
                                                        </div>
                                                    </div>
                                                    <input class="form-control form-control-lg border-0 border-radius-0" v-model="amount" type="text" placeholder="Amount">
                                                </div>
                                                <div class="input-group border-0 border-top border-bottom">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text border-0 text-primary">
                                                            <i class="material-icons">phone</i>
                                                        </div>
                                                    </div>
                                                    <input class="form-control form-control-lg border-0 border-radius-0" v-model="phone" type="tel" placeholder="Phone number">
                                                    <!--<vue-tel-input v-model="phone" defaultCountry="UG" :onlyCountries="['UG']" class="form-control px-0 border-0"></vue-tel-input>-->
                                                </div>
                                                <div class="input-group border-0">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text border-0 text-primary">
                                                            <i class="material-icons">lock</i>
                                                        </div>
                                                    </div>
                                                    <input class="form-control form-control-lg border-0 border-radius-0" v-model="pin" type="password" placeholder="Pin">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer border-top" align="right">
                                            <button class="btn btn-lg btn-pill btn-outline-primary">
                                                <i class="fa fa-check"></i> Initiate
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CreateWithdraw",
        data() {
            return {
                amount: '',
                phone: '',
                pin: ''
            }
        },
        props: {
            shop: {
                type: String
            },
            admin: {
                type: Boolean,
                default: false
            }
        },
        computed: {
            basePath() {
                if (this.admin) {
                    return '/admin/wallet';
                }

                if (this.shop) {
                    return `/shops/${this.shop}/wallet`;
                }

                return '/me/wallet';
            },
            variables() {
                var variables = {};
                if (this.shop) {
                    variables["accountHolder"] = this.shop;
                }

                if (this.admin) {
                    variables["accountHolder"] = 'admin';
                }

                return variables;
            },
        },
        methods: {
            back() {
                this.$router.push(`${this.basePath}/withdraw`);
            }
        },
        watch: {
            amount(data) {
                this.amount = data.replace(/[^\d]/,'');
                if (_.toNumber(data) === 0) {
                    this.amount = '';
                }
            }
        }
    }
</script>

<style scoped>
    .directory .card.main {
        height: calc(99.9vh - 3.75rem - 1px) !important;
    }

    .card-body input {
        border: none !important;
    }
</style>