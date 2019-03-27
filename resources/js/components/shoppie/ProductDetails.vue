<template>
    <div>
        <div class="card">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 py-4">
                        <div class="prod-avatar">
                            <ul class="slider-for-gold">
                                <li><img src="/images/product/detail-gold1.jpg" alt=""></li>
                                <li><img src="/images/product/detail-gold2.jpg" alt=""></li>
                                <li><img src="/images/product/detail-gold3.jpg" alt=""></li>
                                <li><img src="/images/product/detail-gold1.jpg" alt=""></li>
                            </ul>
                            <ul class="slider-nav-gold">
                                <li><img src="/images/product/detail-gold1.jpg" alt=""></li>
                                <li><img src="/images/product/detail-gold2.jpg" alt=""></li>
                                <li><img src="/images/product/detail-gold3.jpg" alt=""></li>
                                <li><img src="/images/product/detail-gold1.jpg" alt=""></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 p-4 border-left product-details">
                        <h3 class="title mb-3">{{ product.name }}</h3>
                        <div class="d-flex align-items-center justify-content-between flex-column flex-sm-row mb-3">
                            <ul class="price list-inline no-margin">
                                <li class="list-inline-item current" v-if="product.discount">UGX {{ product.discounted_price }}</li>
                                <li class="list-inline-item" :class="{original: product.discount, current: !product.discount}">UGX {{ product.price }}</li>
                            </ul>
                            <div class="review d-flex align-items-center">
                                <ul class="rate list-inline">
                                    <li class="list-inline-item"><i class="fa fa-star text-primary"></i></li>
                                    <li class="list-inline-item"><i class="fa fa-star text-primary"></i></li>
                                    <li class="list-inline-item"><i class="fa fa-star text-primary"></i></li>
                                    <li class="list-inline-item"><i class="fa fa-star text-primary"></i></li>
                                    <li class="list-inline-item"><i class="fa fa-star-o text-primary"></i></li>
                                </ul><span class="text-muted">5 reviews</span>
                            </div>
                        </div>
                        <dl class="my-2">
                            <dt>Description</dt>
                            <dd>
                                <p class="my-2">{{ product.description }}</p>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-3">Brand</dt>
                            <dd class="col-sm-9">12345611</dd>

                            <dt class="col-sm-3">Category</dt>
                            <dd class="col-sm-9">Black and white </dd>

                            <dt class="col-sm-3">Subcategory</dt>
                            <dd class="col-sm-9">Russia, USA, and Europe </dd>

                            <dt class="col-sm-3">Orders</dt>
                            <dd class="col-sm-9">154 orders</dd>
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
                        </div>
                        <hr>
                        <a href="javascript:void(0)" class="mb-2 btn btn-pill btn-accent mr-2" @click="cartAction" :class="{disabled: cartStatusLoading}">
                            <i class="fa fa-shopping-cart"></i> {{ cartText }}
                        </a>
                        <a href="javascript:void(0)" class="mb-2 btn btn-pill btn-outline-primary mr-2" @click="favouritesAction" :class="{disabled: favoriteStatusLoading}">
                            <i class="fa fa-heart"></i> {{ favoriteText }}
                        </a>
                        <a :href="messageUrl" class="mb-2 btn btn-pill btn-info mr-2" >
                            <i class="material-icons">message</i> Message Supplier
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-navbar collapse d-lg-flex p-0 bg-white border-bottom border-top sticky">
            <div class="container p-0">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link active"><i class="material-icons">rate_review</i> Reviews</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container py-4">
            <reviews :reviewable="product" reviewable-type="product"></reviews>
            <related-products :product="product" :url="url" class="mt-4"></related-products>
        </div>
    </div>
</template>

<script>
    import RelatedProducts from './RelatedProducts'
    export default {
        name: "ProductDetails",
        components: {RelatedProducts},
        mounted() {
            this.loadImages();
            this.loadProduct();
        },
        data() {
            return {
                inCart: false,
                isFavorite: false,
                cartStatusLoading: false,
                favoriteStatusLoading: false,
                quantity: 1
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
            }
        },
        methods: {
            loadImages() {
                $('.slider-for-gold').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    slide: 'li',
                    fade: false,
                    asNavFor: '.slider-nav-gold'
                });

                $('.slider-nav-gold').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    asNavFor: '.slider-for-gold',
                    dots: false,
                    arrows: true,
                    slide: 'li',
                    vertical: true,
                    centerMode: true,
                    centerPadding: '0',
                    focusOnSelect: true,
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                infinite: true,
                                vertical: false,
                                centerMode: true,
                                dots: false,
                                arrows: false
                            }
                        },
                        {
                            breakpoint: 641,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                infinite: true,
                                vertical: true,
                                centerMode: true,
                                dots: false,
                                arrows: false
                            }
                        },
                        {
                            breakpoint: 420,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                infinite: true,
                                vertical: false,
                                centerMode: true,
                                dots: false,
                                arrows: false
                            }
                        }
                    ]
                });
            },
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

</style>