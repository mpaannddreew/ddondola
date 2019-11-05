<template>
    <div class="directory-area">
        <div class="card card-small h-100 main">
            <div class="card-header p-2 bg-white border-bottom">
                <div class="ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0">
                    <a class="btn btn-white btn-sm text-danger" href="javascript:void(0)" @click="back">
                        <i class="material-icons">clear</i>
                    </a>
                </div>
            </div>
            <div class="card-body h-100 p-4">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="card card-small border user-details" style="margin-top: 4.125rem;">
                            <div class="card-body" style="margin-top: -4.125rem;">
                                <div class="user-details__avatar mx-auto border lis-border-width-4 bg-white p-4" style="box-shadow: none !important; border-radius: 500px !important; border: thin solid #e1e5eb !important;">
                                    <img src="/images/wallet/withdraw_ico.png" alt="User Avatar">
                                </div>
                                <h6 class="text-center m-0 mt-2 mb-4 text-uppercase">Withdraw</h6>
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
                                        <input class="form-control form-control-lg border-0 border-radius-0" v-model="password" type="password" placeholder="Password">
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
                    <div class="col-md-3"></div>
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