<template>
    <section class="py-2">
        <!-- Categories Carousel -->
        <div class="fullwidth-carousel-container margin-top-25">
            <div class="fullwidth-slick-carousel category-carousel">
                <!-- Item -->
                <template v-for="(image, indx) in images">
                    <carousel-image :image="image" :key="indx"></carousel-image>
                </template>
                <!-- Item / End -->
            </div>
        </div>
        <!-- Categories Carousel / End -->
    </section>
</template>

<script>
    import CarouselImage from "./CarouselImage";
    export default {
        name: "ImageCarousel",
        components: {CarouselImage},
        mounted() {
            $('.fullwidth-slick-carousel').slick({
                centerMode: true,
                centerPadding: '20%',
                slidesToShow: this.slidesToShow,
                dots: true,
                arrows: false,
                responsive: [
                    {breakpoint: 1920, settings: {centerPadding: '15%', slidesToShow: this.slidesToShow}},
                    {breakpoint: 1441, settings: {centerPadding: '10%', slidesToShow: this.slidesToShow}},
                    {breakpoint: 1025, settings: {centerPadding: '10px', slidesToShow: this.responsiveSlidesToShow,}},
                    {settings: {centerPadding: '10px', slidesToShow: 1}
                }]
            });
            $(window).on('load resize', function (e) {
                var carouselListItems = $(".fullwidth-slick-carousel .fw-carousel-item").length;
                if (carouselListItems < 4) {
                    $('.fullwidth-slick-carousel .slick-slide').css({'pointer-events': 'all', 'opacity': '1',});
                }
            });

            $('.category-box').each(function () {
                $(this).append('<div class="category-box-background"></div>');
                $(this).children('.category-box-background').css({'background-image': `url(${$(this).attr('data-background-image')})`});
            });
        },
        props: {
            images: {
                type: Array,
                required: true
            },
            slidesToShow: {
                type: Number,
                default: 3
            }
        },
        computed: {
            responsiveSlidesToShow() {
                return this.slidesToShow === 3 ? 2: 1;
            }
        }
    }
</script>

<style scoped>

</style>