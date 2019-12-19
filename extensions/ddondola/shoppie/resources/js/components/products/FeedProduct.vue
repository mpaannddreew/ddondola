<template>
    <div class="central-meta item p-0">
        <div class="user-post p-4">
            <div class="friend-info">
                <figure>
                    <img :alt="product.shop.name" :src="product.shop.avatar.url" class="img-fluid rounded-circle">
                </figure>
                <div class="friend-name">
                    <ins>
                        <a :href="shopUrl" class="name" :title="product.shop.name">{{ product.shop.name }}</a>
                    </ins>
                    <span class="time text-lowercase">{{ product.created_at|fromNow|lowerCase }}</span>
                </div>
            </div>
        </div>
        <div class="post-meta bg-light p-0">
            <figure class="card card-product m-0" style="box-shadow: none !important;">
                <image-carousel :images="product.images" :slides-to-show="1" class="bg-light"></image-carousel>
                <figcaption class="info-wrap">
                    <mini-rating-meter :reviewable="product"></mini-rating-meter>
                    <h4 class="title text-ellipsis"><a :href="productUrl">{{ product.name }}</a></h4>
                    <p class="desc m-0">
                        {{ product.description }}
                    </p>
                </figcaption>
                <div class="bottom-wrap">
                    <a href="javascript:void(0)" class="btn btn-sm btn-pill btn-outline-primary float-right"
                       @click="cartAction" :class="{active: inCart, disabled: cartStatusLoading}" title="Cart">
                        <i class="material-icons">add_shopping_cart</i> {{ cartText}}
                    </a>
                    <div class="price-wrap h5">
                        <span class="price-new">{{ product.currencyCode }} {{ product.discountedPrice|commas }}</span>
                        <del class="price-old" v-if="product.discount">{{ product.currencyCode }} {{ product.price|commas }}</del>
                    </div>
                </div>
            </figure>
        </div>
    </div>
</template>

<script>
    import ImageCarousel from "./ImageCarousel";
    export default {
        name: "FeedProduct",
        components: {ImageCarousel},
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
            shopUrl() {
                return `/shops/${this.product.shop.code}`;
            },
            productUrl() {
                return `/products/${this.product.code}`;
            },
            cartText() {
                if (this.inCart) {
                    return 'Remove From Cart';
                }

                return 'Add To Cart';
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