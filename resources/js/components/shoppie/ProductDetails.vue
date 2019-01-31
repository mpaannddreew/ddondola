<template>
    <div>
        <div class="row">
            <div class="col-lg-6">
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
            <div class="col-lg-6 py-5">
                <div class="full-postmeta">

                            <span class="prices style2">
                                <ins>
                                    <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">$</span>122.00
                                    </span>
                                </ins>
                                <del>
                                    <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">$</span>150.00
                                    </span>
                                </del>
                            </span>

                    <h4>Shoes for <span>Men</span> Black</h4>
                    <i>INSPIRED LIVING</i>
                    <p>
                        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor
                    </p>
                    <div>
                        <button type="button" class="mb-2 btn btn-sm btn-pill btn-outline-primary mr-2"><i class="fa fa-cart-plus mr-1"></i> Add to cart</button>
                        <button type="button" class="mb-2 btn btn-sm btn-pill btn-outline-primary mr-2"><i class="fa fa-heart mr-1"></i> Add to wishlist</button>
                    </div>
                    <div class="prod categories">
                        <span class="cat-heading">Categories:
                            <a href="#" title="">Women</a>
                            <a href="#" title="">Shoes</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductDetails",
        mounted() {
            this.loadImages();
        },
        data() {
            return {

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
            }
        }
    }
</script>

<style scoped>

</style>