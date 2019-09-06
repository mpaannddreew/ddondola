<template>
    <div class="card product is-gray border">
        <main-slide :product="product"></main-slide>
        <div class="p-4 title">
            <mini-rating-meter :reviewable="product"></mini-rating-meter>
            <a :href="productUrl" :title="product.name">
                <h3 class="h6 no-margin-bottom m-0 text-ellipsis">{{ product.name }}</h3>
            </a>
            <div class="d-flex mt-2">
                <ul class="price list-inline no-margin my-auto" style="line-height: 1 !important;">
                    <li class="list-inline-item deals_item_price_a">{{ product.currencyCode }} {{ product.discountedPrice|commas }}</li>
                    <li class="list-inline-item deals_item_price_a" style="text-decoration: line-through; font-size: 10px;" :class="{ 'text-primary': product.discount }" v-if="product.discount">{{ product.currencyCode }} {{ product.price|commas }}</li>
                </ul>
                <div class="hover-overlay d-flex align-items-center justify-content-center ml-auto" style="border-radius: 0 !important;" v-if="auth">
                    <div class="CTA d-flex align-items-center justify-content-center">
                        <a class="border-radius" href="javascript:void(0)" @click="cartAction" title="Cart"
                           :class="{disabled: cartStatusLoading || soldOut, 'border-primary text-primary': inCart}">
                            <i class="fa fa-shopping-cart" :class="{'text-primary': inCart}"></i>
                        </a>
                        <a href="javascript:void(0)" @click="favouritesAction" title="Favourite"
                           :class="{disabled: favoriteStatusLoading, 'border-primary text-primary': isFavorite}" class="border-radius ml-1">
                            <i class="fa fa-heart" :class="{'text-primary': isFavorite}"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MainSlide from "./MainSlide";
    export default {
        name: "ShopProduct",
        components: {MainSlide},
        mounted() {
            this.loadProduct();
        },
        data() {
            return {
                inCart: false,
                isFavorite: false,
                cartStatusLoading: false,
                favoriteStatusLoading: false
            }
        },
        props: {
            product: {
                type: Object,
                required: true
            }
        },
        computed: {
            productUrl() {
                return `/products/${this.product.code}`;
            },
            imageUrl() {
                return this.product.images[0].url;
            },
            soldOut() {
                return this.product.quantity === 0;
            }
        },
        methods: {
            loadProduct() {
                if (this.auth) {
                    let requests = [this.isInCart(), this.isInFavorites()];
                    axios.all(requests).then(axios.spread(this.loadStatus));
                }
            },
            loadStatus(cartStatus, favoritesStatus) {
                this.cartStatus(cartStatus);
                this.favoritesStatus(favoritesStatus);
            },
            cartStatus(response) {
                this.cartStatusLoading = false;
                this.inCart = response.data.data.inCart;
            },
            cartStatusWithEvents(response) {
                this.cartStatus(response);
                if (this.inCart) {
                    Bus.$emit('cart-size', {type: 'increase', count: 1});
                    DToast("success", "Product added to cart");
                }else {
                    Bus.$emit('cart-size', {type: 'decrease', count: 1});
                    DToast("success", "Product removed from cart");
                }
            },
            favoritesStatus(response) {
                this.favoriteStatusLoading = false;
                this.isFavorite = response.data.data.isFavorite;
            },
            isInCart() {
                this.cartStatusLoading = true;
                return axios.post(graphql.api, {
                    query: graphql.inCart,
                    variables: {id: this.product.id}
                });
            },
            isInFavorites() {
                this.favoriteStatusLoading = true;
                return axios.post(graphql.api, {
                    query: graphql.isFavorite,
                    variables: {id: this.product.id}
                });
            },
            cartAction() {
                this.cartStatusLoading = true;
                if (this.inCart) {
                    axios.post(graphql.api, {
                        query: graphql.removeFromCart,
                        variables: {id: this.product.id}
                    }).then(this.cartStatusWithEvents).catch(function (error) {});
                } else {
                    axios.post(graphql.api, {
                        query: graphql.addToCart,
                        variables: {id: this.product.id, quantity: 1}
                    }).then(this.cartStatusWithEvents).catch(function (error) {});
                }
            },
            favouritesAction() {
                this.favoriteStatusLoading = true;
                if (this.isFavorite) {
                    axios.post(graphql.api, {
                        query: graphql.removeFromFavorites,
                        variables: {id: this.product.id}
                    }).then(this.favoritesStatus).catch(function (error) {});
                } else {
                    axios.post(graphql.api, {
                        query: graphql.addToFavorites,
                        variables: {id: this.product.id}
                    }).then(this.favoritesStatus).catch(function (error) {});
                }
            }
        }
    }
</script>

<style scoped>
</style>