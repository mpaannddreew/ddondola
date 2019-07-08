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
        <div class="checkout-process"  v-else-if="loaded && hasProducts">
            <div class="card">
                <div class="card-header form-wizard-step border-right border-top border-top-right-radius-0">
                    <h5>
                        <a class="btn btn-link" href="javascript:void(0)">
                            <span><i class="material-icons">more_vert</i></span>
                            <i class="material-icons">description</i> Order review
                        </a>
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="check-tab">
                        <div class="order-table">
                            <div class="order-review-table table-responsive">
                                <table class="table table-bordered text-center border-left">
                                    <thead>
                                    <tr class="row-1 border-right">
                                        <th class="row-title">Item</th>
                                        <th class="row-title">Product Name</th>
                                        <th class="row-title">Price</th>
                                        <th class="row-title">Quantity</th>
                                        <th class="row-title">Subtotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template v-for="(product, indx) in products">
                                        <tr class="row-2">
                                            <td class="row-img lo-stats__image">
                                                <img class="border rounded" :src="product.images[0].url" alt="cart-img">
                                            </td>
                                            <td class="product-name"><a :href="'/products/' + product.code">{{ product.name }}</a></td>
                                            <td class="product-price">{{ product.currencyCode }} {{ product.pivot.price }}</td>
                                            <td class="product-quantity">{{ product.pivot.quantity }}</td>
                                            <td class="product-subtotal">{{ product.currencyCode }} {{ product.pivot.sum }}</td>
                                        </tr>
                                    </template>
                                    </tbody>
                                    <tfoot>
                                    <tr class="row-6">
                                        <td class="text-left" colspan="4">Order Total</td>
                                        <td class="product-subtotal text-muted">{{ currencyCode }} {{ cartSubtotal }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-wizard-buttons text-md-right py-2">
                <button class="btn btn-lg btn-pill btn-outline-primary" type="button"><i class="material-icons">payment</i> Make Payment</button>
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