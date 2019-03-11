<template>
    <div>
        <div class="card py-4">
            <div class="container">
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
        <div class="container">
            <!-- todo add different product sections -->
            <related-products :product="product"></related-products>
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
        },
        data() {
            return {

            }
        },
        props: {
            product: {
                type: Object,
                required: true
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