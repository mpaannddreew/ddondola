<template>
    <div>
        <div class="card card-small border" v-if="!loaded">
            <div class="card-body">
                <div align="center"><div class="loader"></div></div>
            </div>
        </div>
        <div class="checkout-process"  v-else-if="loaded && hasProducts">
            <div class="card">
                <div class="card-header form-wizard-step border-right border-top border-top-right-radius-0">
                    <h5>
                        <a class="btn btn-link" href="javascript:void(0)"><span>01</span><i class="material-icons">description</i> Order review</a>
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="check-tab">
                        <div class="order-table">
                            <div class="order-review-table table-responsive">
                                <table class="table table-bordered text-center border-left">
                                    <thead>
                                    <tr class="row-1 border-right">
                                        <th class="row-title text-left">Product Name</th>
                                        <th class="row-title">Price</th>
                                        <th class="row-title">Quantity</th>
                                        <th class="row-title">Subtotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template v-for="(product, indx) in products">
                                        <tr class="row-2">
                                            <td class="product-name">{{ product.name }}</td>
                                            <td class="product-price">{{ product.pivot.price }}</td>
                                            <td class="product-quantity">{{ product.pivot.quantity }}</td>
                                            <td class="product-subtotal">{{ product.pivot.sum }}</td>
                                        </tr>
                                    </template>
                                    </tbody>
                                    <tfoot>
                                    <tr class="row-4">
                                        <td class="text-left" colspan="3">Cart Subtotal</td>
                                        <td class="pr_subtotal">{{ cartSubtotal }}</td>
                                    </tr>
                                    <!--<tr class="row-5">-->
                                        <!--<td class="text-left" colspan="3">Promotional Code</td>-->
                                        <!--<td class="pr_subtotal">-$5.00</td>-->
                                    <!--</tr>-->
                                    <tr class="row-6">
                                        <td class="text-left" colspan="3">Order Total</td>
                                        <td class="product-subtotal">{{ orderTotal }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4 border-top">
                <div class="card-header form-wizard-step border-right border-top-right-radius-0">
                    <h5>
                        <a class="btn btn-link collapsed" href="javascript:void(0)"><span>02</span><i class="material-icons">payment</i> Payment Method</a>
                    </h5>
                </div>
                <div class="card-body border border-top-0">
                    <div class="check-tab">
                        <div class="checkout-form">
                            <div class="chek-form">
                                <div class="form-check">
                                    <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3" value="option3" checked="">
                                    <label class="form-check-label" for="exampleRadios3">Direct Bank Transfer</label>
                                    <p data-method="option3" class="payment-text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. </p>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_option" id="exampleRadios4" value="option4">
                                    <label class="form-check-label" for="exampleRadios4">Check Payment</label>
                                    <p data-method="option4" class="payment-text">Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_option" id="exampleRadios5" value="option5">
                                    <label class="form-check-label" for="exampleRadios5">Paypal</label>
                                    <p data-method="option5" class="payment-text">Pay via PayPal; you can pay with your credit card if you don't have a PayPal account.</p>
                                </div>
                            </div>
                            <div class="form-wizard-buttons text-md-right">
                                <button class="btn btn-lg btn-pill btn-outline-primary" type="button">Place order</button>
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
        name: "Checkout",
        mounted() {
            this.fetchCartProducts();
        },
        data() {
            return {
                products: [],
                loaded: false,
                cartSubtotal: 0
            }
        },
        computed: {
            hasProducts() {
                return this.products.length > 0;
            },
            orderTotal() {
                return this.cartSubtotal;
            }
        },
        methods: {
            fetchCartProducts() {
                axios.post(graphql.api, {query: graphql.myCartProducts})
                    .then(this.loadCartProducts).catch(function (error) {});
            },
            loadCartProducts(response) {
                this.loaded = true;
                this.products = response.data.data.me.cart.products;
                this.cartSubtotal = response.data.data.me.cart.sum;
            }
        }
    }
</script>

<style scoped>

</style>