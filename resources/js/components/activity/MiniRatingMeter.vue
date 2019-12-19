<template>
    <div v-if="reviewee">
        <strong><ul class="list-inline text-warning" v-html="starHtml" :class="extraClass"></ul></strong>
        <small class="text-muted" v-if="showBase">{{ reviewee.averageRating }} average based on {{ reviewee.reviewCount }} {{ text }}</small>
    </div>
</template>

<script>
    export default {
        name: "MiniRatingMeter",
        mounted() {
            this.setReviewee(this.reviewable);
            this.listenForReviewUpdates();
        },
        data() {
            return {
                reviewee: null
            }
        },
        props: {
            reviewable: {
                type: Object,
                required: true
            },
            showBase: {
                type: Boolean,
                default: true
            },
            extraClass: {
                type: String
            }
        },
        computed: {
            starHtml() {
                var stars = "";
                if (this.reviewee) {
                    var split_rating = this.reviewee.averageRating.split(".");
                    var difference = 5 - parseInt(split_rating[0]);
                    for (var i = 1; i <= parseInt(split_rating[0]); i++) {
                        stars += '<li><i class="fa fa-star pr-1"></i></li>';
                        if (i === parseInt(split_rating[0]) && parseInt(split_rating[1]) > 0) {
                            stars += '<li><i class="fa fa-star-half-full pr-1"></i></li>';
                        }

                        if (i === parseInt(split_rating[0]) && difference > 0) {
                            var number = difference;
                            if (parseInt(split_rating[1]) > 0) {
                                number = difference - 1;
                            }

                            for (var j = 1; j <= number; j++) {
                                stars += '<li><i class="fa fa-star-o pr-1"></i></li>';
                            }
                        }
                    }

                    if (difference === 5) {
                        for (var j = 1; j <= difference; j++) {
                            stars += '<li><i class="fa fa-star-o pr-1"></i></li>';
                        }
                    }
                    stars += `<li>${this.reviewee.averageRating}</li>`;
                }

                return stars;
            },
            text() {
                if (this.reviewee) {
                    return this.reviewee.reviewCount === 1 ? 'review' : 'reviews';
                }

                return "";
            },
            channel() {
                if (this.reviewee) {
                    return `reviews.${this.reviewee.code}`;
                }

                return "";
            }
        },
        methods: {
            listenForReviewUpdates() {
                Echo.channel(this.channel)
                    .listen('.update.reviews', (e) => {
                        this.setReviewee(e);
                    });
            },
            setReviewee(reviewee) {
                this.reviewee = reviewee;
            }
        }
    }
</script>

<style scoped>

</style>