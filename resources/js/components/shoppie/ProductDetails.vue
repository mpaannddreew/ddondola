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
                <div class="product_description">
                    <div class="product_category">Laptops</div>
                    <div class="product_name">MacBook Air 13</div>
                    <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
                    <div class="product_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum. laoreet turpis, nec sollicitudin dolor cursus at. Maecenas aliquet, dolor a faucibus efficitur, nisi tellus cursus urna, eget dictum lacus turpis.</p></div>
                    <div class="order_info d-flex flex-row">
                        <form action="#">
                            <div class="clearfix" style="z-index: 1000;">

                                <div class="quantity_filter" style="margin: 0;">
                                    <button type="button" class="minus btn btn-sm btn-pill btn-outline-primary border-bottom-right-radius-0 border-top-right-radius-0" @click="minus">-</button>
                                    <input class="quantity-number qty" type="text" v-model="quantity" min="1" max="10">
                                    <button type="button" class="plus btn btn-sm btn-pill btn-outline-primary border-bottom-left-radius-0 border-top-left-radius-0" @click="plus">+</button>
                                </div>

                            </div>

                            <div class="product_price my-5">$2000</div>
                            <div class="button_container">
                                <button type="button" class="btn btn-sm btn-pill btn-outline-primary"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                                <button type="button" class="btn btn-sm btn-pill btn-outline-primary"><i class="fa fa-heart"></i> Add to Favourites</button>
                            </div>

                        </form>
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