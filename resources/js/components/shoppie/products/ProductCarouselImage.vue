<template>
    <div class="fw-carousel-item">
        <div class="category-box-container">
            <a href="javascript:void(0)" class="category-box" :data-background-image="image.url">
                <!--<div class="category-box-content">-->
                    <!--<mini-rating-meter :reviewable="product"></mini-rating-meter>-->
                    <!--<h3 class="text-ellipsis">{{ product.name }}</h3>-->
                <!--</div>-->
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductCarouselImage",
        props: {
            image: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>