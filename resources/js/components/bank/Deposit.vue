<template>
    <div class="directory-area">
        <div class="card card-small h-100 main">
            <div class="card-body h-100 p-5">
                <div class="card card-small h-100 border">
                    <div class="card-header bg-light p-0 border-bottom">
                        <div class="input-group border-0 border-bottom-radius-0">
                            <div class="input-group-prepend">
                                <div class="input-group-text border-bottom-radius-0 border-top-right-radius-0 border-0 text-primary">
                                    <i class="material-icons" style="font-size: 40px;">dialpad</i>
                                </div>
                            </div>
                            <input class="bg-light border-left form-control form-control-lg border-0
                            border-bottom-radius-0 border-top-left-radius-0" v-model="amount"
                                   type="text" placeholder="Deposit amount">
                        </div>
                    </div>
                    <div class="card-body h-100 p-0">
                        <ul class="number m-0 p-0 h-100">
                            <li class="pad" v-for="button in 9">
                                <a class="btn btn-white d-flex" href="javascript:void(0)" @click="typeNumber(button)">
                                    <span style="display: block !important;" class="my-auto mx-auto">{{ button }}</span>
                                </a>
                            </li><li class="pad border-top">
                            <a class="btn btn-danger d-flex clear" :class="clearDisabled" href="javascript:void(0)" @click="clear">
                                <span style="display: block !important;" class="my-auto mx-auto"><i class="fa fa-times-circle"></i> Clear</span>
                            </a>
                        </li><li class="pad border-left border-right border-bottom">
                            <a class="btn btn-white d-flex" href="javascript:void(0)" @click="typeNumber(0)">
                                <span style="display: block !important;" class="my-auto mx-auto">0</span>
                            </a>
                        </li><li class="pad border-top">
                            <a class="btn btn-success d-flex initiate" :class="initiateDisabled" href="javascript:void(0)" @click="initiate">
                                <span style="display: block !important;" class="my-auto mx-auto"><i class="fa fa-check-circle"></i> Initiate</span>
                            </a>
                        </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Deposit",
        data() {
            return {
                amount: '',
                paymentModal: null,
                account: null
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
            initiateDisabled() {
                return {
                    disabled: !this.canInitiate
                };
            },
            canInitiate() {
                return _.toNumber(this.amount) > 5000;
            },
            clearDisabled() {
                return {
                    disabled: this.amount.length === 0
                }
            },
            metaValue() {
                if (this.admin) {
                    return 'admin';
                }

                if (this.shop) {
                    return this.shop;
                }

                return this.authCode;
            },
            meta() {
                return [{metaname: "code", metavalue: this.metaValue}];
            }
        },
        methods: {
            clear() {
                this.amount = '';
            },
            initiate() {
                if (this.canInitiate)
                    this.paymentModal = this.openPaymentModal(this.amount, 'me@ddondola.com', 'UGX', this.meta, this.raveCallback);
            },
            typeNumber(number) {
                this.amount += `${number}`
            },
            raveCallback(response) {
                var txref = response.tx.txRef;
                console.log("This is the response returned after a charge", response);
                if (response.tx.chargeResponseCode === "00" || response.tx.chargeResponseCode === "0") {
                    // todo redirect to a success page
                } else {
                    // todo redirect to a failure page.
                }

                if (this.paymentModal) {
                    this.paymentModal.close(); // use this to close the modal immediately after payment.
                }
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

    ul.number {
        list-style: none !important;
    }

    ul.number li.pad {
        display: inline-block !important;
        width: 33.33333333333333% !important;
        height: 25% !important;
    }

    ul.number li.pad:nth-child(2), ul.number li.pad:nth-child(5), ul.number li.pad:nth-child(8) {
        border-right: thin solid #e1e5eb !important;
        border-left: thin solid #e1e5eb !important;
    }

    ul.number li.pad:nth-child(4), ul.number li.pad:nth-child(5), ul.number li.pad:nth-child(6) {
        border-top: thin solid #e1e5eb !important;
        border-bottom: thin solid #e1e5eb !important;
    }

    ul.number li.pad:nth-child(8) {
        border-bottom: thin solid #e1e5eb !important;
    }

    ul.number li.pad a {
        height: 100% !important;
        width: 100% !important;
        border: none !important;
        border-radius: 0 !important;
    }

    ul.number li.pad a span {
        font-weight: bold !important;
    }

    ul.number li.pad a.clear {
        border-bottom-left-radius: .25rem !important;
    }

    ul.number li.pad a.initiate {
        border-bottom-right-radius: .25rem !important;
    }

    input {
        height: 80px !important;
        font-size: 30px !important;
    }
</style>