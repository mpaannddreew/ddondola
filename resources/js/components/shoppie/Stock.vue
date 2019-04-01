<template>
    <div>
        <div class="header-navbar collapse d-lg-flex p-0 bg-white border-bottom">
            <div class="container p-0">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-left mb-4 mb-sm-0">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="nav-link" :class="{ active: showing === 'all' }" @click="showAll"><i class="material-icons">list</i> All</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);"  class="nav-link" :class="{ active: showing === 'in' }" @click="showIn"><i class="material-icons">done</i> In stock</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);"  class="nav-link" :class="{ active: showing === 'out' }" @click="showOut"><i class="material-icons">clear</i> Out Stock</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-6 d-flex align-items-center">
                        <div class="btn-group btn-group-sm ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" role="group" aria-label="Table row actions">
                            <a href="#update-stock" data-toggle="modal" class="btn btn-success">
                                <i class="material-icons">mode_edit</i> Update Stock
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-4">
            <div class="card card-small lo-stats border">
                <table class="table mb-0">
                    <thead class="py-2 bg-light text-semibold border-bottom">
                    <tr>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Type</th>
                        <th>Note</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-if="!loaded">
                        <tr>
                            <td colspan="4">
                                <div align="center"><div class="loader"></div></div>
                            </td>
                        </tr>
                    </template>
                    <template v-else-if="!showStock && loaded">
                        <tr>
                            <td colspan="4">
                                <div align="center">
                                    <h4>
                                        <i class="material-icons">error_outline</i>
                                        <br />
                                        <small>No stock!</small>
                                    </h4>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <template v-else-if="showStock && loaded">
                        <tr v-for="(_stock, indx) in stock" :key="indx">
                            <td class="lo-stats__items text-center">{{ _stock.quantity }}</td>
                            <td class="lo-stats__items text-center">{{ _stock.type === "STOCK_IN" ? "in": "out" }}</td>
                            <td>{{ _stock.note }}</td>
                            <td>{{ humanize(_stock.created_at) }}</td>
                        </tr>
                    </template>
                    </tbody>
                </table>
            </div>
            <pagination v-if="paginatorInfo" class="my-4" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
            <div class="modal fade" id="update-stock" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card card-small mb-3" style="background: none !important;">
                                <div class="card-header border-bottom">
                                    <h6 class="m-0"><i class="material-icons">mode_edit</i> Update Stock</h6>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-group">
                                            <input id="quantity" class="form-control form-control-md" type="number" placeholder="Quantity" v-model="quantity">
                                            <div class="invalid-feedback" id="quantity_feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control  form-control-md custom-select custom-select-md" v-model="type">
                                                <option value="STOCK_IN" selected>In</option>
                                                <option value="STOCK_OUT">Out</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control form-control-md" placeholder="Note" v-model="note" id="note"></textarea>
                                            <div class="invalid-feedback" id="note_feedback"></div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <button type="button" class="btn btn-md btn-pill btn-outline-primary" :class="{disabled: loading}" @click="validate"><i class="material-icons">check</i> Update</button>
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
    </div>
</template>

<script>
    export default {
        name: "Stock",
        mounted() {
            this.showAll();
        },
        data() {
            return {
                quantity: '',
                type: 'STOCK_IN',
                note: '',
                stock: [],
                page: 1,
                count: 10,
                available: '',
                showing: 'all',
                loaded: false,
                loading: false,
                error: false,
                paginatorInfo: null
            }
        },
        props: {
            product: {
                type: Object,
                required: true
            }
        },
        methods: {
            showAll() {
                this.loaded = false;
                this.showing = 'all';
                this.loadPage(1);
            },
            showIn() {
                this.loaded = false;
                this.showing = 'in';
                this.loadPage(1);
            },
            showOut() {
                this.loaded = false;
                this.showing = 'out';
                this.loadPage(1);
            },
            fetchStock() {
                axios.post(graphql.api, {
                    query: graphql.productStock,
                    variables: {id: this.product.id, type: this.showing, count: this.count, page: this.page}
                }).then(this.loadStock).catch(function (error) {})
            },
            loadStock(response) {
                console.log(JSON.stringify(response.data));
                this.loaded = true;
                this.stock = response.data.data.product.stock.data;
                this.paginatorInfo = response.data.data.product.stock.paginatorInfo;
            },
            validate() {
                if (!this.quantity.length > 0)
                    this.showError('quantity', "Quantity is required");

                if (!this.note.length > 0)
                    this.showError('note', "Please add a note");

                if (!this.error) {
                    this.updateStock();
                }
            },
            updateStock() {
                this.loading = true;
                axios.post(graphql.api, {
                    query: graphql.updateStock,
                    variables: {productId: this.product.id, stock: {quantity: this.quantity, note: this.note, type: this.type}}
                }).then(this.clearForm).catch(function (error) {});
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
                this.loading = false;
                if (response.data.data.stock) {
                    this.quantity = '';
                    this.note = '';

                    this.showAll();

                    DToast("success", "Stock updated successfully");
                    $("#update-stock").modal('hide');
                }else {
                    $("#update-stock").modal('hide');
                    DToast("danger", "Stock not enough!");
                }
            },
            humanize(date) {
                return Moment(date).format("dddd, MMMM Do YYYY, h:mm:ss a");
                // return Moment(date).fromNow();
            },
            loadPage(page) {
                this.page = page;
                this.fetchStock();
            }
        },
        computed: {
            showStock() {
                return this.stock.length > 0;
            }
        },
        watch: {
            quantity(data) {
                if (data.length > 0) {
                    this.clearError("quantity");
                }
            },
            note(data) {
                if (data.length > 0) {
                    this.clearError("note");
                }
            }
        }
    }
</script>

<style scoped>

</style>