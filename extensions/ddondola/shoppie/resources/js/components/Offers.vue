<template>
    <div>
        <div class="mb-2">
            <div class="row no-gutters">
                <div class="col-12 col-sm-6 mb-2 mb-lg-0">
                    <select class="form-control form-control-sm custom-select custom-select-sm" style="max-width: 130px;" v-model="ordering">
                        <option value="all" selected>All</option>
                        <option value="active">Active</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="expired">Expired</option>
                    </select>
                </div>
                <div class="col-12 col-sm-6 d-flex align-items-center">
                    <div class="btn-group btn-group-sm ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" role="group" aria-label="Table row actions">
                        <a href="#new-offer" data-toggle="modal" class="btn btn-success">
                            <i class="material-icons">add</i> New Offer
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-small lo-stats border border-top-radius-0">
            <table class="table mb-0">
                <thead class="py-2 bg-light text-semibold border-bottom">
                <tr>
                    <th class="text-center">Discount</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Cancelled</th>
                    <th>active</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <template v-if="!loaded || (!hasOffers && loaded)">
                    <tr>
                        <td colspan="6">
                            <div align="center" v-if="!loaded">
                                <div class="loader"></div>
                                <p class="m-0">Loading offers...</p>
                            </div>
                            <div align="center" v-if="!hasOffers && loaded">
                                <h4 class="m-0"><i class="material-icons">error</i></h4>
                                <p class="m-0">There are no offers added for this product yet!</p>
                            </div>
                        </td>
                    </tr>
                </template>
                <template v-else-if="hasOffers && loaded">
                    <tr v-for="(offer, indx) in offers" :key="indx">
                        <td class="text-center">{{ offer.discount }}%</td>
                        <td>{{ offer.start_date|humanise }}</td>
                        <td>{{ offer.end_date|humanise }}</td>
                        <td>{{ offer.cancelled }}</td>
                        <td>{{ offer.active }}</td>
                        <td>
                            <div class="btn-group d-table ml-auto" role="group">
                                <a href="javascript:void(0)" class="btn btn-sm btn-white"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-sm btn-white"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
        <pagination v-if="paginatorInfo" class="my-2" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
        <div class="modal fade" id="new-offer" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-small">
                            <div class="card-header border-bottom">
                                <h6 class="m-0"><i class="material-icons">add</i> New Offer</h6>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <label>Offer Dates</label>
                                        <div class="input-daterange input-group input-group-md w-100">
                                            <input type="text" class="input-sm form-control form-control-sm" placeholder="Start Date" id="start_date">
                                            <input type="text" class="input-sm form-control form-control-sm" placeholder="End Date" id="end_date">
                                            <span class="input-group-append">
                                                <span class="input-group-text">
                                                  <i class="material-icons">date_range</i>
                                                </span>
                                            </span>
                                        </div>
                                        <div class="invalid-feedback" id="date_feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="discount">Discount</label>
                                        <input type="text" class="form-control form-control-sm" id="discount" v-model="discount">
                                        <div class="invalid-feedback" id="discount_feedback"></div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="button" class="btn btn-md btn-pill btn-outline-primary" :class="{disabled: loading}" @click="validate"><i class="material-icons">check</i> Save</button>
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
        name: "Offers",
        mounted() {
            this.fetchOffers();
            this.bindEvents();
        },
        data() {
            return {
                discount: '',
                offers: [],
                loaded: false,
                loading: false,
                error: false,
                page: 1,
                ordering: 'all',
                paginatorInfo: null
            }
        },
        props: {
            product: {
                type: Object,
                required: true
            }
        },
        computed: {
            hasOffers() {
                return this.offers.length > 0;
            }
        },
        methods: {
            fetchOffers() {
                this.loaded = false;
                this.offers = [];
                axios.post(graphql.api, {
                    query: graphql.productsOffers,
                    variables: {id: this.product.id, ordering: this.ordering, count: graphql.rowCount, page: this.page}
                }).then(this.loadOffers).catch(function (error) {});
            },
            loadOffers(response) {
                this.loaded = true;
                this.offers = response.data.data.product.offers.data;
                this.paginatorInfo = response.data.data.product.offers.paginatorInfo;
            },
            createOffer() {
                this.loading = true;
                axios.post(graphql.api, {
                    query: graphql.createProductOffer,
                    variables: {
                        productId: this.product.id,
                        offer: {
                            discount: this.discount,
                            start_date: $("#start_date").val(),
                            end_date: $("#end_date").val(),
                        }
                    }
                }).then(this.clearForm).catch(function (error) {});
            },
            loadPage(page) {
                this.page = page;
                this.fetchOffers();
            },
            validate() {
                if (!this.discount.length > 0)
                    this.showError('discount', "Discount is required");

                if (!$("#start_date").val().length > 0) {
                    this.showError('start_date', "");
                    this.showError('date', "Start and End dates are required");
                }

                if (!$("#end_date").val().length > 0) {
                    this.showError('end_date', "");
                    this.showError('date', "Start and End dates are required");
                }

                if (!this.error) {
                    this.createOffer();
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
            },
            clearForm(response) {
                if (response.data.data.offer) {
                    this.discount = '';
                    this.start_date = '';
                    this.end_date = '';
                    this.loading = false;
                    $("#new-offer").modal('hide');
                    DToast("success", "Offer created successfully");
                    this.loadPage(1);
                }else {
                    $("#new-offer").modal('hide');
                    DToast("error", "Product already has a running offer");
                }
            },
            bindEvents() {
                $("#start_date").bind('input change', function () {
                    if ($(this).val().length > 0) {
                        $('#start_date').removeClass('is-invalid');
                        $("#date_feedback").hide();
                        this.error = false;
                    }
                });

                $("#end_date").bind('input change', function () {
                    if ($(this).val().length > 0) {
                        $('#end_date').removeClass('is-invalid');
                        $("#date_feedback").hide();
                        this.error = false;
                    }
                });
            }
        },
        watch: {
            ordering(data) {
                this.loadPage(1);
            },
            discount(data) {
                if (data.length > 0) {
                    this.clearError("discount");
                }
            }
        }
    }
</script>

<style scoped>

</style>