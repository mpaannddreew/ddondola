<template>
    <div>
        <div class="directory-area">
            <div class="card card-small main">
                <div class="card-body h-100">
                    <div class="p-5">
                        <div class="mb-2 align-items-center">
                            <div class="ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0">
                                <a class="btn btn-white btn-sm text-danger" href="javascript:void(0)" @click="transitionBack">
                                    <i class="material-icons">arrow_back</i>
                                </a>
                            </div>
                        </div>
                        <div class="flat-card is-auto order-list-card p-4 border bg-white border-radius">
                            <div class="order-block">
                                <div class="order-payment-method w-100 bg-white py-0">
                                    <div class="single-payment-method">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="wallet" value="wallet" class="custom-control-input" checked="" v-model="method">
                                                <label class="custom-control-label" for="wallet">Pay with Wallet</label>
                                            </div>
                                        </div>
                                        <div class="payment-method-details" v-if="wallet">
                                            <p>Make payment with your Ddondola wallet.</p>
                                        </div>
                                    </div>
                                    <div class="single-payment-method">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="mobile-money" value="mobile-money" class="custom-control-input" v-model="method">
                                                <label class="custom-control-label" for="mobile-money">Pay with Mobile Money</label>
                                            </div>
                                        </div>
                                        <div class="payment-method-details" v-if="mobileMoney">
                                            <p>Make payment with your Mobile Money wallet.</p>
                                        </div>
                                    </div>
                                    <div class="single-payment-method">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="card" value="card" class="custom-control-input" v-model="method">
                                                <label class="custom-control-label" for="card">Pay with Card</label>
                                            </div>
                                        </div>
                                        <div class="payment-method-details" v-if="card">
                                            <p>Make payment with your Debit/Credit card</p>
                                        </div>
                                    </div>

                                    <div class="summary-footer-area">
                                        <div class="custom-control custom-checkbox mb-20">
                                            <input type="checkbox" class="custom-control-input" id="terms" required="" v-model="agreed">
                                            <label class="custom-control-label" for="terms">I have read and agree to
                                                the <a href="javascript:void(0)">terms and conditions.</a></label>
                                        </div>
                                        <a href="javascript:void(0)" class="btn btn-outline-primary btn-pill btn-lg mt-4" :class="{disabled: !agreed}">Make Payment</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Payment",
        mounted(){

        },
        data() {
            return {
                method: 'wallet',
                agreed: false
            }
        },
        props: {
            order: {
                type: String,
                required: true
            }
        },
        computed: {
            orderRoute() {
                return `/me/orders/${this.order}`;
            },
            wallet() {
                return this.method === 'wallet';
            },
            mobileMoney() {
                return this.method === 'mobile-money';
            },
            card() {
                return this.method === 'card';
            }
        },
        methods: {
            transitionBack() {
                this.$router.push(this.orderRoute);
            }
        }
    }
</script>

<style scoped>

</style>