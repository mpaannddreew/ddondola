<template>
    <div class="card card-small border">
        <div class="card-body p-0">
            <div class="deals m-0">
                <div class="deals_title">Active shop deals</div>
                <div class="deals_slider_container">

                    <!-- Deals Slider -->
                    <div class="owl-carousel owl-theme deals_slider">

                        <!-- Deals Item -->
                        <deal></deal>

                        <!-- Deals Item -->
                        <deal></deal>

                        <!-- Deals Item -->
                        <deal></deal>

                    </div>

                </div>

                <div class="deals_slider_nav_container">
                    <div class="deals_slider_prev deals_slider_nav"><i class="fa fa-chevron-left ml-auto"></i></div>
                    <div class="deals_slider_next deals_slider_nav"><i class="fa fa-chevron-right ml-auto"></i></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Deal from "./Deal";
    export default {
        name: "Deals",
        components: {Deal},
        mounted() {
            this.initDealsSlider();
        },
        data() {
            return {

            }
        },
        methods: {
            initDealsSlider() {
                if($('.deals_slider').length)
                {
                    var dealsSlider = $('.deals_slider');
                    dealsSlider.owlCarousel(
                        {
                            items:1,
                            loop:false,
                            navClass:['deals_slider_prev', 'deals_slider_next'],
                            nav:false,
                            dots:false,
                            smartSpeed:1200,
                            margin:30,
                            autoplay:false,
                            autoplayTimeout:5000
                        });

                    if($('.deals_slider_prev').length)
                    {
                        var prev = $('.deals_slider_prev');
                        prev.on('click', function()
                        {
                            dealsSlider.trigger('prev.owl.carousel');
                        });
                    }

                    if($('.deals_slider_next').length)
                    {
                        var next = $('.deals_slider_next');
                        next.on('click', function()
                        {
                            dealsSlider.trigger('next.owl.carousel');
                        });
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>