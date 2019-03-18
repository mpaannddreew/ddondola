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
                    <div class="col-lg-6 p-4 border-left">
                        <div>
                            <h3 class="title mb-3">{{ product.name }}</h3>

                            <div class="mb-3">
                                <var class="price h3 text-warning">
                                    <span class="currency">UGX </span><span class="num">{{ product.price }}</span>
                                </var>
                            </div> <!-- price-detail-wrap .// -->
                            <dl>
                                <dt>Description</dt>
                                <dd>
                                    <p>{{ product.description }}</p>
                                </dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3">Model#</dt>
                                <dd class="col-sm-9">12345611</dd>

                                <dt class="col-sm-3">Color</dt>
                                <dd class="col-sm-9">Black and white </dd>

                                <dt class="col-sm-3">Delivery</dt>
                                <dd class="col-sm-9">Russia, USA, and Europe </dd>
                            </dl>
                            <div class="rating-wrap">

                                <ul class="rating-stars">
                                    <li style="width:80%" class="stars-active">
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </li>
                                </ul>
                                <div class="label-rating">132 reviews</div>
                                <div class="label-rating">154 orders </div>
                            </div> <!-- rating-wrap.// -->
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <dl class="row">
                                        <dt class="col-sm-3">Quantity: </dt>
                                        <dd class="col-sm-9">
                                            <div class="quantity_filter m-0">
                                                <button type="button" class="minus btn btn-sm btn-pill btn-outline-primary border-bottom-right-radius-0 border-top-right-radius-0" @click="minus">-</button>
                                                <input class="quantity-number qty" type="text" v-model="quantity" min="1" max="10">
                                                <button type="button" class="plus btn btn-sm btn-pill btn-outline-primary border-bottom-left-radius-0 border-top-left-radius-0" @click="plus">+</button>
                                            </div>
                                        </dd>
                                    </dl>  <!-- item-property .// -->
                                </div> <!-- col.// -->
                            </div> <!-- row.// -->
                            <hr>
                            <a href="javascript:void(0)" class="btn  btn-success" @click="favouritesAction" :class="{disabled: favoriteStatusLoading}">
                                <i class="material-icons">favorite_border</i> {{ favoriteText }}
                            </a>
                            <a href="javascript:void(0)" class="btn  btn-outline-primary" @click="cartAction" :class="{disabled: cartStatusLoading}">
                                <i class="material-icons">add_shopping_cart</i> {{ cartText }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-navbar collapse d-lg-flex p-0 bg-white border-bottom border-top">
            <div class="container p-0">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="#" class="nav-link active"><i class="material-icons">rate_review</i> Reviews</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container py-4">
            <reviews></reviews>
            <related-products :product="product" :url="url"></related-products>
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
                        variables: {id: this.product.id, quantity: this.quantity}
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
            },
            minus() {
                this.quantity --;
            },
            plus() {
                this.quantity ++;
            }
        },
        watch: {
            quantity: {
                handler(quantity) {
                    if (quantity < 1) {
                        this.quantity = 1;
                    }else if (quantity > this.inStock) {
                        this.quantity = this.inStock;
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>