<template>
    <div class="review-box clearfix">
        <figure class="rev-thumb">
            <img :src="review.reviewer.avatar" alt="" class="rounded-circle">
        </figure>
        <div class="rev-content border">
            <div class="rating text-warning">
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>
            </div>
            <div class="rev-info">
                {{ review.reviewer.name }} – {{ date}}
            </div>
            <div class="rev-text">
                <p>
                    {{ review.body }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Review",
        props: {
            review: {
                type: Object,
                required: true
            }
        },
        computed: {
            date() {
                return Moment(this.review.created_at).fromNow();
            }
        }
    }
</script>

<style scoped>

</style>