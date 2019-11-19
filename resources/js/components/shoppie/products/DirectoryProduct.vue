<template>
    <li class="directory-product">
        <div class="card card-small card-post card-post--1 h-100">
            <div class="card-post__image border-top-radius-0" :style="`background-image: url('${product.images[0].url}');`">
                <a href="javascript:void(0)" class="card-post__category badge badge-pill badge-light">
                    <ul class="price list-inline no-margin my-auto mx-0">
                        <li class="list-inline-item deals_item_price_a m-0" style="font-size: 10px;">{{ product.currencyCode }} {{ product.discountedPrice|commas }}</li>
                        <li class="list-inline-item deals_item_price_a" :class="{ 'text-primary': product.discount }" style="text-decoration: line-through; font-size: 10px;" v-if="product.discount">{{ product.currencyCode }} {{ product.price|commas }}</li>
                    </ul>
                </a>
                <!--<div class="card-post__author d-flex">-->
                <!--<a href="#" class="card-post__author-avatar card-post__author-avatar&#45;&#45;small" style="background-image: url('/images/testimonial/happy-client-01.jpg');">Written by James Jamerson</a>-->
                <!--</div>-->
            </div>
            <div class="card-body p-2" align="center">
                <a :href="productUrl">
                    <p class="text-ellipsis m-0" style="line-height: 1.286em;">{{ product.name }}</p>
                </a>
                <strong>
                    <mini-rating-meter :reviewable="product"></mini-rating-meter>
                </strong>
                <small class="text-muted">{{ product.averageRating }} average based on {{ product.reviewCount }} {{ text }}</small>
            </div>
            <div class="card-footer p-0 border-top">
                <div class="header-navbar collapse d-lg-flex p-0 bg-light border-bottom">
                    <div class="container p-0">
                        <div class="row">
                            <div class="col">
                                <ul class="nav nav-tabs nav-justified border-0 flex-column flex-lg-row">
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" @click="cartAction" class="nav-link" :class="{disabled: cartStatusLoading || soldOut || !auth, active: inCart}">
                                            <i class="material-icons">add_shopping_cart</i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" @click="favouritesAction" class="nav-link":class="{disabled: favoriteStatusLoading || !auth, active: isFavorite}">
                                            <i class="material-icons">favorite_border</i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        name: "DirectoryProduct",
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
                return this.product.reviewCount === 1 ? 'review': 'reviews';
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
                if (this.auth) {
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
                }
            },
            favouritesAction() {
                if (this.auth) {
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
    }
</script>

<style scoped>
    .nav-link {
        margin: 0 !important;
    }

    .nav-item {
        border-right: 1px solid #e1e5eb!important;
    }

    .nav-item:last-child {
        border-right: none !important;
    }
</style>