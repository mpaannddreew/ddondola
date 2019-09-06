<template>
    <li class="product">
        <div class="product-outer" style="height: 363px;">
            <div class="product-inner">
                <span class="loop-product-categories" style="display: unset !important;">
                    <a href="javascript:void(0)" rel="tag">{{ product.category.name }}</a>
                </span>
                <a :href="productUrl">
                    <h3 class="text-ellipsis">{{ product.name }}</h3>
                    <div class="my-3">
                        <mini-rating-meter :reviewable="product"></mini-rating-meter>
                        <small class="text-muted">{{ product.averageRating }} average based on {{ product.reviewCount }} {{ text }}</small>
                    </div>
                    <div class="product-thumbnail">
                        <main-slide :product="product"></main-slide>
                    </div>
                </a>
                <div class="price-add-to-cart m-0 pt-3">
                    <span class="price w-100">
                        <span class="electro-price">
                            <div class="products-grid p-0">
                                <div class="product m-0">
                                    <div class="d-flex mt-2">
                                        <ul class="price list-inline no-margin my-auto mx-0">
                                            <li class="list-inline-item deals_item_price_a m-0">{{ product.currencyCode }} {{ product.discountedPrice|commas }}</li>
                                            <li class="list-inline-item deals_item_price_a" :class="{ 'text-primary': product.discount }" style="text-decoration: line-through; font-size: 10px;" v-if="product.discount">{{ product.currencyCode }} {{ product.price|commas }}</li>
                                        </ul>
                                        <div class="hover-overlay d-flex align-items-center justify-content-center ml-auto" style="border-radius: 0 !important;" v-if="auth">
                                            <div class="CTA d-flex align-items-center justify-content-center">
                                                <a class="border-radius" href="javascript:void(0)" @click="cartAction"
                                                   :class="{disabled: cartStatusLoading || soldOut, 'border-primary text-primary': inCart}">
                                                    <i class="fa fa-shopping-cart" :class="{'text-primary': inCart}"></i>
                                                </a>
                                                <a href="javascript:void(0)" @click="favouritesAction"
                                                   :class="{disabled: favoriteStatusLoading, 'border-primary text-primary': isFavorite}" class="border-radius ml-1">
                                                    <i class="fa fa-heart" :class="{'text-primary': isFavorite}"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
    import MainSlide from "./MainSlide";
    export default {
        name: "DirectoryProduct",
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
            text() {
                return this.product.reviewCount === 1 ? 'rating': 'ratings';
            },
            productUrl() {
                return `/products/${this.product.code}`;
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