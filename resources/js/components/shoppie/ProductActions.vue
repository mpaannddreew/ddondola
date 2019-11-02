<template>
    <div class="btn-group d-table ml-auto" role="group" v-if="auth">
        <a href="javascript:void(0)" @click="favouritesAction" :class="{disabled: favoriteStatusLoading}" class="btn btn-outline-primary active">
            <i class="fa fa-heart"></i> {{ favText }}
        </a>
        <a href="javascript:void(0)" @click="cartAction" :class="{disabled: cartStatusLoading || soldOut}" class="btn btn-outline-primary">
            <i class="fa fa-shopping-cart"></i> {{ cartText}}
        </a>
    </div>
</template>

<script>
    export default {
        name: "ProductActions",
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
            soldOut() {
                return this.product.quantity === 0;
            },
            cartText() {
                if (this.inCart) {
                    return 'Remove From Cart';
                }

                return 'Add To Cart';
            },
            favText() {
                if (this.isFavorite) {
                    return 'Remove From Wishlist';
                }

                return 'Add To Wishlist';
            },
            auth() {
                return Auth;
            }
        },
        methods: {
            loadProduct() {
                if (Auth) {
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