<template>
    <ul class="list-inline text-warning" v-html="starHtml"></ul>
</template>

<script>
    export default {
        name: "MiniRatingMeter",
        props: {
            reviewable: {
                type: Object,
                required: true
            }
        },
        computed: {
            starHtml() {
                var stars = "";
                var split_rating = this.reviewable.averageRating.split(".");
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
                stars += '<li>' + this.reviewable.averageRating + '</li>';
                return stars;
            }
        }
    }
</script>

<style scoped>

</style>