<template>
    <div class="row">
        <div class="col-md-8">
            <div class="mb-2">
                <div class="row no-gutters">
                    <div class="col-12 col-sm-6 mb-2 mb-lg-0">
                        <select class="form-control form-control-sm custom-select custom-select-sm" style="max-width: 130px;" v-model="showing">
                            <option value=""></option>
                            <option value="in">Stock in</option>
                            <option value="out">Stock out</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card card-small border" id="stock">
                <div class="card-body p-0 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">Quantity</th>
                            <th scope="col" class="border-0">Type</th>
                            <th scope="col" class="border-0">Note</th>
                            <th scope="col" class="border-0">Date</th>
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
                                <td>{{ _stock.quantity }}</td>
                                <td>{{ _stock.type === "STOCK_IN" ? "in": "out" }}</td>
                                <td>{{ _stock.note }}</td>
                                <td>{{ humanize(_stock.created_at) }}</td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
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
                                <option value="in" selected>Stock in</option>
                                <option value="out">Stock out</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control form-control-md" placeholder="Note" v-model="note" id="note"></textarea>
                            <div class="invalid-feedback" id="note_feedback"></div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="button" class="btn btn-success" :class="{disabled: loading}" @click="validate">Update</button>
                            <button class="btn btn-link p-0" v-show="loading"><div class="loader loader-sm"></div></button>
                        </div>
                    </form>
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
                available: '',
                showing: 'all',
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
            queryVariables() {
                var variables = {id: this.product.id, count: this.count, page: this.page};
                if (this.showing) {
                    variables['type'] = this.showing;
                }
                return variables;
            },
            fetchStock() {
                axios.post(graphql.api, {
                    query: graphql.productStock,
                    variables: this.queryVariables
                }).then(this.loadStock).catch(function (error) {})
            },
            loadStock(response) {
                this.loaded = true;
                this.stock = response.data.data.product.stock.data;
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

                DToast("success", "Stock updated!");
            },
            humanize(date) {
                return Moment(date).format("dddd, MMMM Do YYYY, h:mm:ss a");
            }
        },
        computed: {
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
                this.loaded = false;
                this.fetchStock();
            }
        }
    }
</script>

<style scoped>

</style>