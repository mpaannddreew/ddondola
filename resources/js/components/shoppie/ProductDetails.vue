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