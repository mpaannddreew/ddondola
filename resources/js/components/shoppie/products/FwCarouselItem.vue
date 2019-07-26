<template>
    <div class="fw-carousel-item">
        <div class="category-box-container">
            <a :href="href" class="category-box" data-background-image="/images/product/9.jpg">
                <div class="category-box-content">
                    <mini-rating-meter :reviewable="product"></mini-rating-meter>
                    <h3 class="text-ellipsis">{{ product.name }}</h3>
                </div>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FwCarouselItem",
        props: {
            product: {
                type: Object,
                required: true
            }
        },
        computed: {
            href() {
                return '/products/' + this.product.code;
            }
        }
    }
</script>

<style scoped>

</style>