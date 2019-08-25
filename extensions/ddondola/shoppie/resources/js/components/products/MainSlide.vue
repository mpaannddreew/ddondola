<template>
    <div :id="carouselId" class="main-slide carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <template v-for="(image, indx) in product.images">
                <div class="carousel-item" :class="{active: indx === 0}">
                    <img class="d-block w-100" :src="image.url" :alt="product.name">
                </div>
            </template>
        </div>
        <a class="carousel-control-prev" :href="`#${carouselId}`" role="button" data-slide="prev">
            <span class="carousel-control" aria-hidden="true"><i class="fa fa-chevron-left" data-ripple-color="#F0F0F0"></i></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" :href="`#${carouselId}`" role="button" data-slide="next">
            <span class="carousel-control" aria-hidden="true"><i class="fa fa-chevron-right" data-ripple-color="#F0F0F0"></i></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</template>

<script>
    export default {
        name: "MainSlide",
        props: {
            product: {
                type: Object,
                required: true
            }
        },
        computed: {
            carouselId() {
                return `main-slide-${this.product.id}`;
            }
        },
    }
</script>

<style scoped>

</style>