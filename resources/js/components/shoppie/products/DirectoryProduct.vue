<template>
    <li class="product">
        <div class="product-outer" style="height: 363px;">
            <div class="product-inner">
                <span class="loop-product-categories">
                    <a href="javascript:void(0)" rel="tag">{{ product.category.name }}</a>
                </span>
                <a :href="productUrl">
                    <h3 class="text-ellipsis">{{ product.name }}</h3>
                    <div class="my-3">
                        <mini-rating-meter :reviewable="product"></mini-rating-meter>
                        <small class="text-muted">{{ product.averageRating }} average based on {{ product.reviewCount }} {{ text }}</small>
                    </div>
                    <div class="product-thumbnail">
                        <div :id="carouselId" class="main-slide carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="/images/product/9.jpg" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="/images/product/9.jpg" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="/images/product/9.jpg" alt="Third slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" :href="'#' + carouselId" role="button" data-slide="prev">
                                <span class="carousel-control" aria-hidden="true">
                                    <i class="fa fa-chevron-left" data-ripple-color="#F0F0F0"></i>
                                </span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" :href="'#' + carouselId" role="button" data-slide="next">
                                <span class="carousel-control" aria-hidden="true">
                                    <i class="fa fa-chevron-right" data-ripple-color="#F0F0F0"></i>
                                </span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </a>
                <div class="price-add-to-cart m-0 pt-3">
                    <span class="price w-100">
                        <span class="electro-price">
                            <ins><span class="amount">{{ product.currencyCode }} {{ product.discountedPrice }}</span></ins>
                            <del v-if="product.discount"><span class="amount">{{ product.currencyCode }} {{ product.price }}</span></del>
                            <span class="amount"></span>
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        name: "DirectoryProduct",
        mounted() {
        },
        data() {
            return {}
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
                return '/products/' + this.product.code;
            },
            carouselId() {
                return 'main-slide-' + this.product.id;
            }
        },
        methods: {

        }
    }
</script>

<style scoped>

</style>