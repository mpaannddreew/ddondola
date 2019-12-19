<template>
    <div>
        <header class="d-flex justify-content-between align-items-start m-0 mb-2">
            <div>
                <a class="btn btn-white btn-sm ml-auto" href="javascript:void(0)" @click="toCart">
                    <i class="fa fa-edit"></i> Edit
                </a>
            </div>
            <div class="ml-auto" v-if="loaded && hasProducts">
                <a class="btn btn-white btn-sm ml-auto" :href="checkoutUrl"
                   onclick="event.preventDefault(); document.getElementById('checkout').submit();">
                    <i class="fa fa-check-circle"></i> Confirm
                </a>
                <form id="checkout" :action="checkoutUrl" method="POST" style="display: none;">
                    <input type="hidden" name="_token" v-model="token"/>
                </form>
            </div>
        </header>
        <div class="card card-small border" v-if="!loaded">
            <div class="card-body">
                <div align="center">
                    <div class="loader"></div>
                    <p class="m-0">Preparing checkout...</p>
                </div>
            </div>
        </div>
        <template v-else-if="loaded && hasProducts">
            <section class="cart-section card border">
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
                                <td class="product-name"><a :href="`${productDirectoryUrl}/${product.code}`">{{ product.name }}</a></td>
                                <td class="product-price"><p>{{ product.currencyCode }} {{ product.pivot.price|commas }}</p></td>
                                <td class="product-quantity">{{ product.pivot.quantity }}</td>
                                <td class="product-total"><p>{{ product.currencyCode }} {{ product.pivot.sum|commas }}</p></td>
                            </tr>
                        </template>
                        <tr class="row-6">
                            <td class="text-left text-uppercase border-0" colspan="4">Cart Total</td>
                            <td class="product-subtotal text-muted">{{ currencyCode }} {{ cartSubtotal|commas }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </template>
    </div>
</template>

<script>
    export default {
        name: "Checkout",
        mounted() {
            this.fetchCartProducts();
            this.setCsrf();
        },
        data() {
            return {
                products: [],
                loaded: false,
                cartSubtotal: 0,
                token: null
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
            cartRoute() {
                return '/me/cart';
            },
            checkoutUrl() {
                return `${this.cartRoute}/checkout`;
            },
            productDirectoryUrl() {
                return '/products';
            }
        },
        methods: {
            toCart() {
                this.$router.push(this.cartRoute);
            },
            fetchCartProducts() {
                this.loaded = false;
                axios.post(graphql.api, {query: graphql.myCartProducts})
                    .then(this.loadCartProducts).catch(function (error) {});
            },
            loadCartProducts(response) {
                this.loaded = true;
                this.products = response.data.data.me.cart.products;
                this.cartSubtotal = response.data.data.me.cart.sum;
            },
            setCsrf() {
                this.token = this.csrf;
            }
        }
    }
</script>

<style scoped>

</style>