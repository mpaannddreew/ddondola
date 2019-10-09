<template>
    <div>
        <div class="mb-2">
            <div class="row no-gutters">
                <div class="col-12 col-sm-6 mb-2 mb-lg-0">
                    <select class="form-control form-control-sm custom-select custom-select-sm" style="max-width: 130px;" v-model="showing">
                        <option value=""></option>
                        <option value="in">Stock in</option>
                        <option value="out">Stock out</option>
                    </select>
                </div>
                <div class="col-12 col-sm-6 d-flex align-items-center">
                    <div class="btn-group btn-group-sm ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" role="group" aria-label="Table row actions">
                        <a href="#stock-update" data-toggle="modal" class="btn btn-success">
                            <i class="material-icons">add</i> Stock Update
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-small lo-stats border border-top-radius-0">
            <table class="table mb-0">
                <thead class="py-2 bg-light text-semibold border-bottom">
                <tr>
                    <th scope="col" class="border-0">Quantity</th>
                    <th scope="col" class="border-0">In</th>
                    <th scope="col" class="border-0">Out</th>
                    <th scope="col" class="border-0">Note</th>
                    <th scope="col" class="border-0">Date</th>
                </tr>
                </thead>
                <tbody>
                <template v-if="!loaded || !showStock && loaded">
                    <tr>
                        <td colspan="5">
                            <div align="center" v-if="!loaded">
                                <div class="loader"></div>
                                <p class="m-0">Loading stock details...</p>
                            </div>
                            <div align="center" v-if="!showStock && loaded">
                                <h4 class="m-0"><i class="material-icons">error</i></h4>
                                <p class="m-0">This product has no stock details</p>
                            </div>
                        </td>
                    </tr>
                </template>
                <template v-else-if="showStock && loaded">
                    <tr v-for="(_stock, indx) in stock" :key="indx" :title="`Added by ${_stock.user.name}`" data-toggle="tooltip">
                        <td>{{ _stock.quantity }}</td>
                        <td>
                            <i class="fa" :class="{'fa-check-circle text-success': _stock.in, 'fa-times-circle text-danger': _stock.out}"></i>
                        </td>
                        <td>
                            <i class="fa" :class="{'fa-check-circle text-success': _stock.out, 'fa-times-circle text-danger': _stock.in}"></i>
                        </td>
                        <td>{{ _stock.note }}</td>
                        <td>{{ humanize(_stock.created_at) }}</td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
        <pagination v-if="paginatorInfo" class="my-2" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
        <div class="modal fade" id="stock-update" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-small">
                            <div class="card-header border-bottom">
                                <h6 class="m-0"><i class="material-icons">add</i> Stock Update</h6>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <input id="quantity" class="form-control form-control-md" type="number" placeholder="Quantity" v-model="quantity">
                                        <div class="invalid-feedback" id="quantity_feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control  form-control-md custom-select custom-select-md" v-model="type">
                                            <option value="in" selected>Stock in</option>
                                            <option value="out">Stock out</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control form-control-md" placeholder="Note" v-model="note" id="note"></textarea>
                                        <div class="invalid-feedback" id="note_feedback"></div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="button" class="btn btn-md btn-pill btn-outline-primary" :class="{disabled: loading}" @click="validate">Update</button>
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
        name: "Stock",
        mounted() {
            this.fetchStock();
        },
        data() {
            return {
                quantity: '',
                type: 'in',
                note: '',
                stock: [],
                page: 1,
                count: 10,
                paginatorInfo: null,
                showing: '',
                loaded: false,
                loading: false,
                error: false
            }
        },
        props: {
            product: {
                type: Object,
                required: true
            }
        },
        methods: {
            fetchStock() {
                this.loaded = false;
                this.stock = [];
                axios.post(graphql.api, {
                    query: graphql.productStock,
                    variables: this.queryVariables
                }).then(this.loadStock).catch(function (error) {})
            },
            loadStock(response) {
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
                    variables: {productId: this.product.id, stock: {quantity: this.quantity, note: this.note, in: this.in, out: !this.in}}
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
                this.quantity = '';
                this.note = '';

                if ((this.showing === 'all' || this.showing === 'in') && this.in)
                    this.stock.unshift(response.data.data.stock);

                if ((this.showing === 'all' || this.showing === 'out') && !this.in)
                    this.stock.unshift(response.data.data.stock);

                $("#stock-update").modal('hide');
            },
            humanize(date) {
                return Moment(date).format("dddd, MMMM Do YYYY, h:mm:ss a");
            },
            loadPage(page) {
                this.page = page;
                this.fetchStock();
            }
        },
        computed: {
            queryVariables() {
                var variables = {id: this.product.id, count: this.count, page: this.page};
                if (this.showing) {
                    variables['type'] = this.showing;
                }
                return variables;
            },
            showStock() {
                return this.stock.length > 0;
            },
            in() {
                return this.type === 'in';
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
            },
            showing(data) {
                this.loadPage(1);
            }
        }
    }
</script>

<style scoped>

</style>