<template>
    <div class="carousel-item">
        <a :href="href" class="listing-item-container">
            <div class="listing-item">
                <img src="/images/product/9.jpg" alt="">
                <div class="listing-item-content">
                    <h3 class="text-ellipsis">{{ shop.name }} <i class="verified-icon"></i></h3>
                    <span>{{ shop.profile.address }}</span>
                </div>
            </div>
            <div class="star-rating" data-rating="3.5">
                <div class="rating-counter">
                    <mini-rating-meter :reviewable="shop"></mini-rating-meter>
                </div>
            </div>
        </a>
    </div>
</template>

<script>
    export default {
        name: "CarouselItem",
        props: {
            shop: {
                type: Object,
                required: true
            }
        },
        computed: {
            href() {
                return '/shops/' + this.shop.code;
            }
        }
    }
</script>

<style scoped>

</style>