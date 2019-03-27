<template>
    <div>
        <div class="card card-small border" v-if="!loaded">
            <div class="card-body">
                <div align="center"><div class="loader"></div></div>
            </div>
        </div>
        <div align="center" v-else-if="!hasProducts && loaded">
            <h4>
                <i class="material-icons">error_outline</i>
                <br />
                <small>You have not added any products to cart!</small>
                <br />
                <a :href="shoppingUrl" class="btn btn-xs btn-success">Start Shopping</a>
            </h4>
        </div>
        <template v-else-if="hasProducts && loaded">
            <section class="cart-section card border">
                <div class="row">
                    <div class="col-md-12">
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                <tr class="row-1" style="border-bottom: 0;">
                                    <th class="row-title"><p>Item</p></th>
                                    <th class="row-title"><p>Product Name</p></th>
                                    <th class="row-title"><p>Price</p></th>
                                    <th class="row-title"><p>Quantity</p></th>
                                    <th class="row-title"><p>Subtotal</p></th>
                                    <th class="row-title"><p></p></th>
                                </tr>
                                </thead>
                                <tbody>
                                <template v-for="(product, indx) in products">
                                    <tr is="cart-entry" :key="indx" :product="product" v-on:product="removedFromCart"></tr>
                                </template>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="12">
                                        <ul class="table-btn m-0 p-0">
                                            <li>
                                                <a :href="shoppingUrl" class="mb-2 btn btn-lg btn-pill btn-outline-primary mr-2">
                                                    <i class="fa fa-chevron-left"></i> Continue Shopping
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <section class="order-details py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 pl-0">
                            <coupon-code></coupon-code>
                        </div>
                        <div class="col-lg-6 pr-0 mb-4">
                            <order-summary></order-summary>
                        </div>
                        <div class="col-lg-12 text-center">
                            <a :href="checkoutUrl" class="btn btn-lg btn-pill btn-outline-primary" style="text-transform: uppercase;">
                                Proceed to checkout <i class="fa fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </div>
</template>

<script>
    import CartEntry from "./CartEntry";
    import CouponCode from "./CouponCode";
    import OrderSummary from "./OrderSummary";
    export default {
        name: "Cart",
        components: {OrderSummary, CouponCode, CartEntry},
        mounted() {
            this.fetchCartProducts();
        },
        data() {
            return {
                products: [],
                loaded: false
            }
        },
        props: {
            checkoutUrl: {
                type: String,
                required: true
            },
            shoppingUrl: {
                type: String,
                required: true
            }
        },
        computed: {
            hasProducts() {
                return this.products.length > 0;
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
            },
            removedFromCart(product) {
                this.products = Collect(this.products).reject(function(value, key) {
                    return value.id === product;
                }).all();
            }
        }
    }
</script>

<style scoped>

</style>