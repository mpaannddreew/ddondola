<template>
    <div class="card card-small mb-2 border">
        <div class="card-body p-4">
            <ul class="list-inline mb-0 lis-light-gold font-weight-normal h4 text-warning">
                <span v-html="starHtml"></span>
                <li class="list-inline-item"> {{ reviewable.averageRating }}</li>
            </ul>
            <small>{{ reviewable.averageRating }} average based on {{ reviewable.reviewCount }} {{ text }}</small>
        </div>
    </div>
</template>

<script>
    export default {
        name: "RatingMeter",
        props: {
            reviewable: {
                type: Object,
                required: true
            }
        },
        computed: {
            text() {
                return this.reviewable.reviewCount === 1 ? 'rating': 'ratings';
            },
            starHtml() {
                var stars = "";
                var split_rating = this.reviewable.averageRating.split(".");
                var difference = 5 - parseInt(split_rating[0]);
                for (var i = 1; i <= parseInt(split_rating[0]); i++) {
                    stars += '<li class="list-inline-item"><i class="fa fa-star"></i></li>';
                    if (i === parseInt(split_rating[0]) && parseInt(split_rating[1]) > 0) {
                        stars += '<li class="list-inline-item"><i class="fa fa-star-half-full"></i></li>';
                    }

                    if (i === parseInt(split_rating[0]) && difference > 0) {
                        var number = difference;
                        if (parseInt(split_rating[1]) > 0) {
                            number = difference - 1;
                        }

                        for (var j = 1; j <= number; j++) {
                            stars += '<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                        }
                    }
                }

                if (difference === 5) {
                    for (var j = 1; j <= difference; j++) {
                        stars += '<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                    }
                }

                return stars;
            }
        }
    }
</script>

<style scoped>

</style>