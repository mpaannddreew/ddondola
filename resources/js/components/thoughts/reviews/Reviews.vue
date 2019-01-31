<template>
    <section id="reviews">
        <div class="reviews-container">
            <div is="review" v-for="(indx, review) in reviews"></div>
        </div>
        <review-form></review-form>
        <!-- /review-container -->
    </section>
</template>

<script>
    import Review from "./Review";
    import ReviewForm from "./ReviewForm";
    export default {
        name: "Reviews",
        components: {ReviewForm, Review},
        data() {
            return {
                reviews: [1, 2, 3]
            }
        }
    }
</script>

<style scoped>

</style>