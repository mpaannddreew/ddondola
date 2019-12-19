<template>
    <tr>
        <td class="lo-stats__image">
            <img class="border rounded" :src="imageUrl">
        </td>
        <td class="lo-stats__order-details">
            <span>{{ product.name }}</span>
            <span class="text-uppercase">
                <mini-rating-meter :reviewable="product" :show-base="false"></mini-rating-meter>
            </span>
        </td>
        <td class="lo-stats__items">{{ product.brand ? product.brand.name : '' }}</td>
        <td class="lo-stats__items">{{ product.category.name }}</td>
        <td class="lo-stats__items">{{ product.subcategory.name }}</td>
        <td class="lo-stats__items">{{ product.currencyCode }} {{ product.discountedPrice|commas }}</td>
        <td>
            <div class="btn-group d-table ml-auto" role="group">
                <a :href="productUrl" class="btn btn-sm btn-white" title="">
                    <i class="fa fa-link"></i> Details
                </a>
                <template v-if="auth">
                    <a class="btn btn-sm btn-white" href="javascript:void(0)" @click="cartAction" title="Cart"
                       :class="{disabled: cartStatusLoading || soldOut, 'border-primary text-primary': inCart}">
                        <i class="fa fa-shopping-cart" :class="{'text-primary': inCart}"></i>
                    </a>
                    <a href="javascript:void(0)" @click="favouritesAction" title="Favourite"
                       :class="{disabled: favoriteStatusLoading, 'border-primary text-primary': isFavorite}" class="btn btn-sm btn-white">
                        <i class="fa fa-heart" :class="{'text-primary': isFavorite}"></i>
                    </a>
                </template>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        name: "ProductRow",
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
                axios.post(graphql.api, {
                    query: graphql.favourite,
                    variables: {id: this.product.id}
                }).then(this.favoritesStatus).catch(function (error) {});
            }
        }
    }
</script>

<style scoped>

</style>