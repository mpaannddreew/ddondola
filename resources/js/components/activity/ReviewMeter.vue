<template>
    <div class="reviews-container">
        <div class="row">
            <div class="col-lg-3">
                <div id="review_summary">
                    <strong>{{ reviewable.averageRating }}</strong>
                    <em>{{ badge }}</em>
                    <small>Based on {{ reviewable.reviewCount }} {{ text }}</small>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-10 col-9">
                        <div class="progress border">
                            <div class="progress-bar" role="progressbar" :style="`width: ${fiveStarPercentage}%`" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-3"><small><strong>5 stars</strong></small></div>
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-lg-10 col-9">
                        <div class="progress border">
                            <div class="progress-bar" role="progressbar" :style="`width: ${fourStarPercentage}%`" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-3"><small><strong>4 stars</strong></small></div>
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-lg-10 col-9">
                        <div class="progress border">
                            <div class="progress-bar" role="progressbar" :style="`width: ${threeStarPercentage}%`" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-3"><small><strong>3 stars</strong></small></div>
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-lg-10 col-9">
                        <div class="progress border">
                            <div class="progress-bar" role="progressbar" :style="`width: ${twoStarPercentage}%`" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-3"><small><strong>2 stars</strong></small></div>
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-lg-10 col-9">
                        <div class="progress border">
                            <div class="progress-bar" role="progressbar" :style="`width: ${oneStarPercentage}%`" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-3"><small><strong>1 star</strong></small></div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <!-- /row -->
    </div>
</template>

<script>
    export default {
        name: "ReviewMeter",
        props: {
            reviewable: {
                type: Object,
                required: true
            }
        },
        computed: {
            text() {
                return this.reviewable.reviewCount === 1 ? 'review': 'reviews';
            },
            badge() {
                if (this.reviewable.averageRating >= 4)
                    return 'Superb';
                else if (this.reviewable.averageRating >= 3)
                    return 'Very Good';
                else if (this.reviewable.averageRating >= 2)
                    return 'Good';
                else
                    return 'Pleasant';
            },
            oneStarPercentage() {
                return (this.reviewable.oneStarCount/this.reviewable.reviewCount) * 100;
            },
            twoStarPercentage() {
                return (this.reviewable.twoStarCount/this.reviewable.reviewCount) * 100;
            },
            threeStarPercentage() {
                return (this.reviewable.threeStarCount/this.reviewable.reviewCount) * 100;
            },
            fourStarPercentage() {
                return (this.reviewable.fourStarCount/this.reviewable.reviewCount) * 100;
            },
            fiveStarPercentage() {
                return (this.reviewable.fiveStarCount/this.reviewable.reviewCount) * 100;
            }
        }
    }
</script>

<style scoped>

</style>