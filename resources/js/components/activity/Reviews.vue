<template>
    <div>
        <div class="card card-small border">
            <div class="card-header border-bottom">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-left mb-sm-0">
                        <h5 class="page-title m-0"><img src="/images/feed.png" alt="" style="filter: grayscale(100%);"> Reviews</h5>
                    </div>
                    <div class="col-12 col-sm-6 d-flex align-items-center">
                        <div class="btn-group btn-group-sm ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" role="group" aria-label="Table row actions">
                            <a href="#review-form" class="btn btn-success" data-toggle="modal" :class="{disabled: !isReviewedLoaded}">
                                <i class="material-icons">rate_review</i> {{ reviewText }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <template v-if="!loaded">
                    <div align="center" class="p-4"><div class="loader"></div></div>
                </template>
                <template v-else-if="!hasReviews && loaded">
                    <div align="center" class="p-4">
                        <h4>
                            <i class="material-icons">error_outline</i>
                            <br />
                            <small>No reviews about this entity have been added. Be the first!</small>
                        </h4>
                    </div>
                </template>
                <review v-else-if="hasReviews && loaded" v-for="(review, indx) in reviews" :review="review" :key="indx"></review>
            </div>
        </div>
        <!--<a href="javascript:void(0)" class="btn-view btn-load-more border"></a>-->
        <pagination v-if="paginatorInfo" class="my-4" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
        <div class="modal fade" id="review-form" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-small">
                            <div class="card-header border-bottom">
                                <h5 class="m-0"><i class="material-icons">rate_review</i> {{ reviewText }}</h5>
                            </div>
                            <div class="card-body">
                                <form v-if="!isReviewed">
                                    <div class="form-group">
                                        <label>Rating </label>
                                        <div class="custom-select-form">
                                            <select name="rating_review" id="rating" class="form-control custom-select" v-model="rating">
                                                <option value="1">1 (lowest)</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5" selected="">5 (highest)</option>
                                            </select>
                                        </div>
                                        <div class="invalid-feedback" id="rating_feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Your Review</label>
                                        <textarea name="review_text" id="review" class="form-control" style="height:130px;" v-model="body" v-if="!isReviewed"></textarea>
                                        <div class="invalid-feedback" id="review_feedback"></div>
                                    </div>
                                    <div class="form-groupadd_top_20 add_bottom_30">
                                        <button @click="validate" :class="{disabled: loading}" type="button" class="btn btn-md btn-pill btn-outline-primary" id="submit-review">
                                            <i class="material-icons">check</i> Submit
                                        </button>
                                        <button class="btn btn-link p-0" v-show="loading"><div class="loader loader-sm"></div></button>
                                    </div>
                                </form>
                                <form v-else-if="isReviewed && review">
                                    <div class="form-group">
                                        <label>Rating </label>
                                        <div class="custom-select-form">
                                            <select name="rating_review" id="edit_rating" class="form-control custom-select" v-model="review.rating">
                                                <option value="1">1 (lowest)</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5" selected="">5 (highest)</option>
                                            </select>
                                        </div>
                                        <div class="invalid-feedback" id="edit_rating_feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Your Review</label>
                                        <textarea name="review_text" id="edit_review" class="form-control" style="height:130px;" v-model="review.body"></textarea>
                                        <div class="invalid-feedback" id="edit_review_feedback"></div>
                                    </div>
                                    <div class="form-groupadd_top_20 add_bottom_30">
                                        <button @click="validate" :class="{disabled: loading}" type="button" class="btn btn-md btn-pill btn-outline-primary">
                                            <i class="material-icons">check</i> Submit
                                        </button>
                                        <button class="btn btn-link p-0" v-show="loading"><div class="loader loader-sm"></div></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Reviews",
        mounted() {
            this.loadAll();
        },
        data() {
            return {
                reviews: [],
                isReviewed: false,
                isReviewedLoaded: false,
                page: 1,
                loaded: false,
                paginatorInfo: null,
                rating: "",
                body: "",
                loading: false,
                error: false,
                review: null,
            }
        },
        props: {
            reviewable: {
                type: Object,
                required: true
            },
            reviewableType: {
                type: String,
                required: true
            }
        },
        computed: {
            hasReviews() {
                return this.reviews.length > 0;
            },
            query() {
                return this.reviewableType === 'shop'? graphql.shopReviews: graphql.productReviews;
            },
            reviewText() {
                return this.isReviewed ? 'Edit your Review': 'Leave a Review';
            },
            editReviewVariables() {
                if (this.isReviewed)
                    return {id: this.review.id, review: {rating: this.review.rating, body: this.review.body}};
                return {};
            }
        },
        methods: {
            loadAll() {
                let requests = [this.reviewRequest(), this.isReviewedRequest()];
                axios.all(requests).then(axios.spread(this.spreadResponse));
            },
            reviewRequest() {
                return axios.post(graphql.api, {
                    query: this.query,
                    variables: {id: this.reviewable.id, count: graphql.rowCount, page: this.page}
                });
            },
            isReviewedRequest() {
                return axios.post(graphql.api, {
                    query: graphql.isReviewed,
                    variables: {entity: {id: this.reviewable.id, type: this.reviewableType}}
                });
            },
            addReviewRequest() {
                return axios.post(graphql.api, {
                    query: graphql.addReview,
                    variables: {entity: {id: this.reviewable.id, type: this.reviewableType}, review: {rating: this.rating, body: this.body}}
                });
            },
            editReviewRequest() {
                return axios.post(graphql.api, {
                    query: graphql.editReview,
                    variables: this.editReviewVariables
                });
            },
            fetchReviews() {
                this.reviews = [];
                this.loaded = false;
                this.reviewRequest().then(this.loadReviews).catch(function (error) {});
            },
            spreadResponse(reviewsRes, isRevRes) {
                this.loadReviews(reviewsRes);
                this.loadIsReviewed(isRevRes);
            },
            loadReviews(response) {
                this.loaded = true;
                this.reviews = [];
                if (this.reviewableType === "shop") {
                    this.reviews = response.data.data.shop.reviews.data;
                    this.paginatorInfo = response.data.data.shop.reviews.paginatorInfo;
                }else {
                    this.reviews = response.data.data.product.reviews.data;
                    this.paginatorInfo = response.data.data.product.reviews.paginatorInfo;
                }
            },
            loadIsReviewed(response) {
                this.isReviewedLoaded = true;
                this.isReviewed = response.data.data.isReviewed.isReviewed;
                this.review = response.data.data.isReviewed.review;
                if (this.isReviewed)
                    this.review.rating = this.review.rating.toString()
            },
            loadPage(page) {
                this.page = page;
                this.fetchReviews();
            },
            addReview() {
                this.addReviewRequest().then(this.loadReview).catch(function (error) {});
            },
            loadReview(response) {
                this.loading = false;
                this.loadAll();
                if (this.isReviewed) {
                    DToast("success", "Your review has been updated");
                } else {
                    DToast("success", "Your review has been added");
                }
                $("#review-form").modal("hide");
            },
            editReview() {
                this.editReviewRequest().then(this.loadReview).catch(function (error) {});
            },
            createReview() {
                this.addReviewRequest().then(this.loadReview).catch(function (error) {});
            },
            submitReview() {
                this.loading = true;
                if (this.isReviewed) {
                    this.editReview();
                } else {
                    this.createReview();
                }
            },
            validate() {
                if (this.isReviewed) {
                    if (!this.review.rating.length)
                        this.showError('edit_rating', "Rating is required");

                    if (!this.review.body.length > 0)
                        this.showError('edit_review', "Review is required");
                } else {
                    if (!this.rating.length)
                        this.showError('rating', "Rating is required");

                    if (!this.body.length > 0)
                        this.showError('review', "Review is required");
                }

                if (!this.error) {
                    this.submitReview();
                }
            },
            clearError(id) {
                $('#' + id).removeClass('is-invalid');
                $('#' + id + "_feedback").hide();
                this.error = false;
            },
            showError(id, message) {
                $('#' + id).addClass('is-invalid');
                $('#' + id + "_feedback").text(message).show();
                this.error = true;
                this.loading = false;
            }
        },
        watch: {
            rating: function (data) {
                if (data.length > 0) {
                    this.clearError("rating");
                }
            },
            body: function (data) {
                if (data.length > 0) {
                    this.clearError("review");
                }
            },
            'review.rating': {
                handler(data) {
                    if (data.length > 0) {
                        this.clearError("edit_rating");
                    }
                }
            },
            'review.body': {
                handler(data) {
                    if (data.length > 0) {
                        this.clearError("edit_review");
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>