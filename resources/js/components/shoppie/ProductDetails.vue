<template>
    <div>
        <div class="container py-2">
            <div class="row">
                <div class="col-md-3 px-1">
                    <rating-meter :reviewable="product"></rating-meter>

                    <div class="card card-small border mb-2" v-if="hasAttributes">
                        <div class="card-header border-bottom">
                            <h5 class="m-0"><i class="material-icons">short_text</i> Product Specifications</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group border-0">
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action d-flex" v-for="(attribute, indx) in attributes">
                                    <span><i class="material-icons">label</i> {{ attribute.name }}</span> <span class="ml-auto">{{ attribute.value }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <related-products :product="product" :url="url"></related-products>

                </div>
                <div class="col-md-9 px-1">
                    <div class="card border mb-2">
                        <div class="row no-gutters">
                            <aside class="col-sm-6 border-right">
                                <article class="gallery-wrap">
                                    <div class="img-big-wrap pt-4">
                                        <div> <a href="/images/product/detail-gold1.jpg" data-fancybox=""><img src="/images/product/detail-gold1.jpg"></a></div>
                                    </div> <!-- slider-product.// -->
                                    <div class="img-small-wrap">
                                        <div class="item-gallery"> <img src="/images/product/detail-gold1.jpg"></div>
                                        <div class="item-gallery"> <img src="/images/product/detail-gold2.jpg"></div>
                                        <div class="item-gallery"> <img src="/images/product/detail-gold3.jpg"></div>
                                        <div class="item-gallery"> <img src="/images/product/detail-gold1.jpg"></div>
                                    </div> <!-- slider-nav.// -->
                                </article> <!-- gallery-wrap .end// -->
                            </aside>
                            <aside class="col-sm-6">
                                <article class="p-4 py-5">
                                    <h3 class="text-uppercase no-margin-bottom text-ellipsis mb-3">{{ product.name }}</h3>
                                    <ul class="mb-3 price list-inline no-margin">
                                        <li class="list-inline-item deals_item_price_a" :class="{ 'text-primary': product.discount }">{{ product.currency_code }} {{ product.discounted_price }}</li>
                                        <li class="list-inline-item deals_item_price_a" style="text-decoration: line-through;" v-if="product.discount">{{ product.currency_code }} {{ product.price }}</li>
                                    </ul>
                                    <dl>
                                        <dt>Description</dt>
                                        <dd>
                                            <p>{{ product.description }}</p>
                                        </dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-sm-4">Brand</dt>
                                        <dd class="col-sm-8">{{ product.brand_name }}</dd>

                                        <dt class="col-sm-4">Category</dt>
                                        <dd class="col-sm-8">{{ product.sub_category.category.name }}</dd>

                                        <dt class="col-sm-4">Subcategory</dt>
                                        <dd class="col-sm-8">{{ product.sub_category.name }}</dd>

                                        <dt class="col-sm-4">Orders</dt>
                                        <dd class="col-sm-8">154 orders</dd>
                                    </dl>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <dl class="dlist-inline">
                                                <dt>Quantity: </dt>
                                                <dd>
                                                    <select class="form-control form-control-sm custom-select custom-select-sm" style="width:70px;" v-model="quantity">
                                                        <option value="1">1</option>
                                                    </select>
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="col-sm-7">
                                            <a href="javascript:void(0)" class="mb-2 btn btn-pill btn-accent mr-2" @click="cartAction" :class="{disabled: cartStatusLoading}">
                                                <i class="fa fa-shopping-cart"></i> {{ cartText }}
                                            </a>
                                        </div>
                                    </div>
                                    <hr>
                                    <a href="javascript:void(0)" class="mb-2 btn btn-pill btn-outline-primary mr-2" @click="favouritesAction" :class="{disabled: favoriteStatusLoading}">
                                        <i class="fa fa-heart"></i> {{ favoriteText }}
                                    </a>
                                    <a :href="messageUrl" class="mb-2 btn btn-pill btn-info mr-2" >
                                        <i class="material-icons">message</i> Message Supplier
                                    </a>
                                </article>
                            </aside>
                        </div>
                    </div>
                    <reviews :reviewable="product" reviewable-type="product"></reviews>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import RelatedProducts from './RelatedProducts'
    export default {
        name: "ProductDetails",
        components: {RelatedProducts},
        mounted() {
            this.loadProduct();
        },
        data() {
            return {
                inCart: false,
                isFavorite: false,
                cartStatusLoading: false,
                favoriteStatusLoading: false,
                quantity: 1,
                reviews: true
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
            favoriteText() {
                return this.isFavorite ? 'Remove from favourites': 'Add to favourites';
            },
            cartText() {
                return this.inCart ? 'Remove from cart': 'Add to cart';
            },
            messageUrl() {
                return '/me/messenger/' + this.product.shop.code;
            },
            attributes() {
                return Collect(this.product.settings).get('attributes', []);
            },
            hasAttributes() {
                return this.attributes.length > 0;
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
                        variables: {id: this.product.id, quantity: this.quantity}
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
        },
        watch: {
            quantity(data) {

            }
        }
    }
</script>

<style scoped>
    .list-group-item {
        border-right: none;
        border-left: none;
    }

    .list-group-item:first-child {
        border-top: none;
        border-top-left-radius: 0px !important;
        border-top-right-radius: 0px !important;
    }

    .list-group-item:last-child {
        border-bottom-right-radius: 4px;
        border-bottom-left-radius: 4px;
        border-bottom: none;
    }

    .h3, h3 {
        font-size: 1.5em;
        line-height: 2.25rem;
    }
</style>