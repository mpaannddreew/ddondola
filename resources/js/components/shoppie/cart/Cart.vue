<template>
    <div>
        <div class="card card-small border" v-if="!loaded || (!hasProducts && loaded)">
            <div class="card-body">
                <div align="center" v-if="!loaded">
                    <div class="loader"></div>
                    <p class="m-0">Loading cart...</p>
                </div>
                <div align="center" v-if="!hasProducts && loaded">
                    <h4 class="m-0"><i class="material-icons">remove_shopping_cart</i></h4>
                    <p class="mb-3">Your cart is empty!</p>
                    <a :href="shoppingUrl" class="btn btn-success btn-pill"><i class="material-icons">shopping_cart</i> Start Shopping</a>
                </div>
            </div>
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
                                    <tr is="cart-entry" :key="indx" :product="product" v-on:deleted="removedFromCart" v-on:cart-updated="fetchCartProducts"></tr>
                                </template>
                                <tr class="row-6">
                                    <td class="text-left border-bottom-0 text-uppercase" colspan="4">Cart Total</td>
                                    <td class="product-subtotal border-0 text-muted">{{ currencyCode }} {{ sum }}</td>
                                    <td></td>
                                </tr>
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
                                            <li>
                                                <a :href="checkoutUrl" class="btn btn-lg btn-pill btn-outline-primary" style="text-transform: uppercase;">
                                                    Proceed to checkout <i class="fa fa-chevron-right"></i>
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
        </template>
    </div>
</template>

<script>
    import CartEntry from "./CartEntry";
    export default {
        name: "Cart",
        components: {CartEntry},
        mounted() {
            this.fetchCartProducts();
        },
        data() {
            return {
                products: [],
                loaded: false,
                sum: null
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
            },
            currencyCode() {
                return this.products[0].currencyCode;
            }
        },
        methods: {
            fetchCartProducts() {
                axios.post(graphql.api, {query: graphql.myCartProducts})
                    .then(this.loadCartProducts).catch(function (error) {});
            },
            loadCartProducts(response) {
                this.loaded = true;
                this.products = [];
                this.products = response.data.data.me.cart.products;
                this.sum = response.data.data.me.cart.sum;
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