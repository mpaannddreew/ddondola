<template>
    <div class="card card-small mb-2 border">
        <div class="card-body p-4">
            <mini-rating-meter :reviewable="reviewable" class="mb-0 lis-light-gold font-weight-normal h4"></mini-rating-meter>
            <small>{{ reviewable.averageRating }} average based on {{ reviewable.reviewCount }} {{ text }}</small>
        </div>
    </div>
</template>

<script>
    import MiniRatingMeter from "./MiniRatingMeter";
    export default {
        name: "RatingMeter",
        components: {MiniRatingMeter},
        props: {
            reviewable: {
                type: Object,
                required: true
            }
        },
        computed: {
            text() {
                return this.reviewable.reviewCount === 1 ? 'review': 'reviews';
            }
        }
    }
</script>

<style scoped>

</style>