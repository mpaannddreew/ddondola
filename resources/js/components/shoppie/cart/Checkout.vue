<template>
    <div>
        <div class="card card-small border" v-if="!loaded">
            <div class="card-body">
                <div align="center">
                    <div class="loader"></div>
                    <p class="m-0">Preparing checkout...</p>
                </div>
            </div>
        </div>
        <div class="checkout-process border"  v-else-if="loaded && hasProducts">
            <div class="card">
                <div class="card-header form-wizard-step border-top-right-radius-0">
                    <h5>
                        <a class="btn btn-link" href="javascript:void(0)">
                            <span><i class="material-icons">more_vert</i></span>
                            <i class="material-icons">description</i> Overview
                        </a>
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="check-tab">
                        <div class="cart-section">
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                    <tr class="row-1">
                                        <th class="row-title"><p>Item</p></th>
                                        <th class="row-title"><p>Product Name</p></th>
                                        <th class="row-title"><p>Price</p></th>
                                        <th class="row-title"><p>Quantity</p></th>
                                        <th class="row-title"><p>Subtotal</p></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template v-for="(product, indx) in products">
                                        <tr class="cart-item">
                                            <td class="row-img lo-stats__image">
                                                <img class="border rounded" :src="product.images[0].url" alt="cart-img">
                                            </td>
                                            <td class="product-name"><a :href="'/products/' + product.code">{{ product.name }}</a></td>
                                            <td class="product-price"><p>{{ product.currencyCode }} {{ product.pivot.price }}</p></td>
                                            <td class="product-quantity">{{ product.pivot.quantity }}</td>
                                            <td class="product-total"><p>{{ product.currencyCode }} {{ product.pivot.sum }}</p></td>
                                        </tr>
                                    </template>
                                    <tr class="row-6">
                                        <td class="text-left text-uppercase" colspan="4">Cart Total</td>
                                        <td class="product-subtotal text-muted">{{ currencyCode }} {{ cartSubtotal }}</td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="5" class="py-3 px-4">
                                            <div class="d-flex">
                                                <a class="btn btn-lg btn-pill btn-outline-primary text-uppercase" href="/me/cart">
                                                    <i class="fa fa-chevron-left"></i> Back To Cart
                                                </a>
                                                <a class="btn btn-lg btn-pill btn-outline-primary ml-auto text-uppercase" href="javascript:void(0)">
                                                    <i class="material-icons">payment</i> Make Payment
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
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
            currencyCode() {
                return this.products[0].currencyCode;
            }
        },
        methods: {
            fetchCartProducts() {
                this.loaded = false;
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