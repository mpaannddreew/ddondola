<template>
    <div>
        <header class="d-flex justify-content-between align-items-start m-0 mb-2">
            <div>
                <a class="btn btn-white btn-sm ml-auto" :href="productDirectoryPath">
                    <i class="fa fa-shopping-basket"></i> Ddondola
                </a>
            </div>
            <div class="ml-auto" v-if="hasProducts && loaded">
                <a class="btn btn-white btn-sm ml-auto" @click="toCheckout" href="javascript:void(0)">
                    <i class="fa fa-check-circle-o"></i> Checkout
                </a>
            </div>
        </header>
        <div class="card card-small border" v-if="!loaded || (!hasProducts && loaded)">
            <div class="card-body">
                <div align="center" v-if="!loaded">
                    <div class="loader"></div>
                    <p class="m-0">Loading cart...</p>
                </div>
                <div align="center" v-if="!hasProducts && loaded">
                    <h4 class="m-0"><i class="material-icons">error</i></h4>
                    <p class="m-0">Your cart is currently empty!</p>
                </div>
            </div>
        </div>
        <template v-else-if="hasProducts && loaded">
            <section class="cart-section card border">
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
                            <td class="text-left border-bottom-0 text-uppercase border-0" colspan="4">Cart Total</td>
                            <td class="product-subtotal border-0 text-muted">{{ currencyCode }} {{ sum|commas }}</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
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
        computed: {
            hasProducts() {
                return this.products.length > 0;
            },
            currencyCode() {
                if (this.hasProducts) {
                    return this.products[0].currencyCode;
                }

                return null;
            },
            checkoutRoute() {
                return '/me/cart/checkout';
            },
            productDirectoryPath() {
                return '/products';
            }
        },
        methods: {
            toCheckout() {
                this.$router.push(this.checkoutRoute);
            },
            fetchCartProducts() {
                this.loaded = false;
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