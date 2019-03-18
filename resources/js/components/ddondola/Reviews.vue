<template>
    <div>
        <section id="reviews">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-sm-left mb-4 mb-sm-0">
                    <h2>Reviews</h2>
                </div>
                <div class="col-12 col-sm-6 d-flex align-items-center">
                    <div class="btn-group btn-group-sm ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" role="group" aria-label="Table row actions">
                        <a href="#review-form" class="btn btn-success" data-toggle="modal">
                            <i class="material-icons">rate_review</i> Leave a Review
                        </a>
                    </div>
                </div>
            </div>
            <div class="reviews-container">
                <div class="review-box clearfix">
                    <figure class="rev-thumb"><img src="/images/avatars/0.jpg" alt="">
                    </figure>
                    <div class="rev-content border">
                        <div class="rating">
                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>
                        </div>
                        <div class="rev-info">
                            Admin – April 03, 2016:
                        </div>
                        <div class="rev-text">
                            <p>
                                Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
                            </p>
                        </div>
                    </div>
                </div>
                <!-- /review-box -->
                <div class="review-box clearfix">
                    <figure class="rev-thumb"><img src="/images/avatars/0.jpg" alt="">
                    </figure>
                    <div class="rev-content border">
                        <div class="rating">
                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>
                        </div>
                        <div class="rev-info">
                            Ahsan – April 01, 2016:
                        </div>
                        <div class="rev-text">
                            <p>
                                Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
                            </p>
                        </div>
                    </div>
                </div>
                <!-- /review-box -->
                <div class="review-box clearfix">
                    <figure class="rev-thumb"><img src="/images/avatars/0.jpg" alt="">
                    </figure>
                    <div class="rev-content border">
                        <div class="rating">
                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>
                        </div>
                        <div class="rev-info">
                            Sara – March 31, 2016:
                        </div>
                        <div class="rev-text">
                            <p>
                                Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
                            </p>
                        </div>
                    </div>
                </div>
                <!-- /review-box -->
            </div>
            <!-- /review-container -->
        </section>
        <div class="modal fade" id="review-form" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="add-review">
                            <h5>Leave a Review</h5>
                            <form>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Rating </label>
                                        <div class="custom-select-form">
                                            <select name="rating_review" id="rating_review" class="form-control custom-select">
                                                <option value="1">1 (lowest)</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5" selected="">5 (highest)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Your Review</label>
                                        <textarea name="review_text" id="review_text" class="form-control" style="height:130px;"></textarea>
                                    </div>
                                    <div class="form-group col-md-12 add_top_20 add_bottom_30">
                                        <button type="submit" class="btn btn-success" id="submit-review"><i class="fa fa-check-circle"></i> Submit</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Reviews"
    }
</script>

<style scoped>

</style>