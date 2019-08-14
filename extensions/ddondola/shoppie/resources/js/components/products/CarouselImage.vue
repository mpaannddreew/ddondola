<template>
    <div class="fw-carousel-item">
        <div class="category-box-container">
            <a href="javascript:void(0)" class="category-box" :data-background-image="image.url"></a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CarouselImage",
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