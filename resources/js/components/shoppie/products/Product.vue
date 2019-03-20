<template>
    <div class="card product is-gray border">
        <div class="image d-flex align-items-center justify-content-center border-bottom">
            <div class="ribbon ribbon-warning text-uppercase" v-if="inCart || isFavorite">
                <i class="fa fa-shopping-cart" v-if="inCart"></i>
                <template v-if="inCart && isFavorite"> | </template>
                <i class="fa fa-heart" v-if="isFavorite"></i>
            </div>
            <div class="ribbon ribbon-info text-uppercase" v-if="product.discount">{{ product.discount }}%</div>
            <img :src="imageUrl" alt="product" class="img-fluid">
            <div class="hover-overlay d-flex align-items-center justify-content-center">
                <div class="CTA d-flex align-items-center justify-content-center">
                    <a href="javascript:void(0)" @click="cartAction" :class="{disabled: cartStatusLoading}">
                        <i class="material-icons">add_shopping_cart</i>
                    </a>
                    <a :href="productUrl" class="visit-product active">
                        <i class="fa fa-search"></i> View
                    </a>
                    <a href="javascript:void(0)" @click="favouritesAction" :class="{disabled: favoriteStatusLoading}">
                        <i class="material-icons">favorite_border</i>
                    </a>
                </div>
            </div>
        </div>
        <div class="p-4 title">
            <small class="text-muted">{{ product.subcategory.name }}</small>
            <a :href="productUrl">
                <h3 class="h6 text-uppercase no-margin-bottom">{{ product.name }}</h3>
            </a>
            <span class="price text-muted">UGX {{ product.price }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShopProduct",
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
            },
            url: {
                type: String,
                required: true
            }
        },
        computed: {
            productUrl() {
                return this.url + "/products/" + this.product.code;
            },
            imageUrl() {
                return "/images/products/hoodie-man-1.png";
            }
        },
        methods: {
            loadProduct() {
                let requests = [this.isInCart(), this.isInFavorites()];
                axios.all(requests).then(axios.spread(this.loadStatus));
            },
            loadStatus(cartStatus, favoritesStatus) {
                this.cartStatus(cartStatus);
                this.favoritesStatus(favoritesStatus);
            },
            cartStatus(response) {
                this.cartStatusLoading = false;
                this.inCart = response.data.data.inCart;
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
                    }).then(this.cartStatus).catch(function (error) {});
                } else {
                    axios.post(graphql.api, {
                        query: graphql.addToCart,
                        variables: {id: this.product.id, quantity: 1}
                    }).then(this.cartStatus).catch(function (error) {});
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