<template>
    <div class="ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0">
        <a class="btn btn-link btn-sm" href="javascript:void(0)">
            <template v-if="loaded">
                Available Bal. {{ depositCurrency }} {{ balance|commas }}
            </template>
            <template v-else>
                Loading balance ...
            </template>
        </a>
        <a class="btn btn-white btn-sm" href="javascript:void(0)" v-if="deposit && depositAmount" @click="doDeposit" :class="{disabled: !loaded}">
            <i class="fa fa-plus"></i> Top Up <span class="text-success" style="font-weight: bold !important;">{{ depositCurrency }} {{ depositAmount|commas }}</span>
        </a>
    </div>
</template>

<script>
    export default {
        name: "QuickWallet",
        mounted() {
            this.load();
        },
        data() {
            return {
                account: null,
                loaded: false,
                paymentModal: null
            }
        },
        props: {
            deposit: {
                type: Boolean,
                default: false
            },
            depositAmount: {
                type: Number,
                required: false
            },
            depositCurrency: {
                type: String,
                default: "UGX"
            },
            accountHolder: {
                type: String,
                required: false
            }
        },
        computed: {
            variables() {
                var variables = {};
                if (this.accountHolder) {
                    variables["accountHolder"] = this.accountHolder;
                }
                return variables;
            },
            holder() {
                return this.account ? this.account.holder: null;
            },
            balance() {
                return this.account? this.account.balance: null;
            },
            meta() {
                return [
                    {
                        metaname: "code",
                        metavalue: this.holder.code
                    }
                ];
            }
        },
        methods: {
            doDeposit() {
                this.paymentModal = this.openPaymentModal(this.depositAmount, this.holder.profile.email, this.depositCurrency, this.meta, this.raveCallback);
            },
            load() {
                axios.post(graphql.api, {query: graphql.account, variables: this.variables})
                    .then(this.prepare).catch(function (error) {})
            },
            prepare(response) {
                this.loaded = true;
                this.account = response.data.data.account;
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
        }
    }
</script>

<style scoped>

</style>