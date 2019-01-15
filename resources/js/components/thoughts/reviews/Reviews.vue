<template>
    <section id="reviews">
        <div class="row no-gutters mb-4">
            <div class="col ml-lg-0">
            </div>
            <div class="col text-right view-report ml-lg-0">
                <div class="d-flex ml-lg-auto my-auto">
                    <div class="btn-group btn-group-sm mr-2  ml-lg-0" role="group" aria-label="Table row actions">
                        <button type="button" class="btn btn-white">
                            <i class="fa fa-check-circle"></i> All
                        </button>
                        <button type="button" class="btn btn-white">
                            5 <i class="fa fa-star"></i>
                        </button>
                        <button type="button" class="btn btn-white">
                            4 <i class="fa fa-star"></i>
                        </button>
                        <button type="button" class="btn btn-white">
                            3 <i class="fa fa-star"></i>
                        </button>
                        <button type="button" class="btn btn-white">
                            2 <i class="fa fa-star"></i>
                        </button>
                        <button type="button" class="btn btn-white">
                            1 <i class="fa fa-star"></i>
                        </button>
                    </div>
                    <a href="#review-form" class="btn btn-sm btn-success d-inline-block ml-auto ml-lg-0" data-toggle="modal">
                        <i class="fa fa-plus"></i> Leave a Review
                    </a>
                </div>
            </div>
        </div>
        <!--<div class="reviews-container add_bottom_30">-->
            <!--<div class="row">-->
                <!--<div class="col-lg-3">-->
                    <!--<div id="review_summary">-->
                        <!--<strong>8.5</strong>-->
                        <!--<em>Superb</em>-->
                        <!--<small>Based on 4 reviews</small>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="col-lg-9">-->
                    <!--<div class="row">-->
                        <!--<div class="col-lg-10 col-9">-->
                            <!--<div class="progress border">-->
                                <!--<div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="col-lg-2 col-3"><small><strong>5 stars</strong></small></div>-->
                    <!--</div>-->
                    <!--&lt;!&ndash; /row &ndash;&gt;-->
                    <!--<div class="row">-->
                        <!--<div class="col-lg-10 col-9">-->
                            <!--<div class="progress border">-->
                                <!--<div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="col-lg-2 col-3"><small><strong>4 stars</strong></small></div>-->
                    <!--</div>-->
                    <!--&lt;!&ndash; /row &ndash;&gt;-->
                    <!--<div class="row">-->
                        <!--<div class="col-lg-10 col-9">-->
                            <!--<div class="progress border">-->
                                <!--<div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="col-lg-2 col-3"><small><strong>3 stars</strong></small></div>-->
                    <!--</div>-->
                    <!--&lt;!&ndash; /row &ndash;&gt;-->
                    <!--<div class="row">-->
                        <!--<div class="col-lg-10 col-9">-->
                            <!--<div class="progress border">-->
                                <!--<div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="col-lg-2 col-3"><small><strong>2 stars</strong></small></div>-->
                    <!--</div>-->
                    <!--&lt;!&ndash; /row &ndash;&gt;-->
                    <!--<div class="row">-->
                        <!--<div class="col-lg-10 col-9">-->
                            <!--<div class="progress border">-->
                                <!--<div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="col-lg-2 col-3"><small><strong>1 stars</strong></small></div>-->
                    <!--</div>-->
                    <!--&lt;!&ndash; /row &ndash;&gt;-->
                <!--</div>-->
            <!--</div>-->
            <!--&lt;!&ndash; /row &ndash;&gt;-->
        <!--</div>-->
        <review-form></review-form>
        <div class="reviews-container">

            <div is="review" v-for="(indx, review) in reviews"></div>
        </div>
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