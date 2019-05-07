<template>
    <tr>
        <td colspan="5" class="bg-light">
            <div class="checkout-process border">
                <div class="card">
                    <div class="card-header form-wizard-step border-top-right-radius-0">
                        <h5>
                            <a class="btn btn-link" href="javascript:void(0)">
                                <span><i class="material-icons">more_vert</i></span>
                                <i class="material-icons">description</i> Order Details
                            </a>
                        </h5>
                    </div>
                    <div class="card-body p-0" style="min-height: unset !important;">
                        <div class="check-tab">
                            <div class="order-table">
                                <div class="order-review-table table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                        <tr class="row-1">
                                            <th class="row-title">Item</th>
                                            <th class="row-title">Product Name</th>
                                            <th class="row-title">Price</th>
                                            <th class="row-title">Quantity</th>
                                            <th class="row-title">Subtotal</th>
                                            <th class="border-right-0"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <template v-if="!loaded">
                                            <tr>
                                                <td colspan="6" class="border-right-0">
                                                    <div align="center" v-if="!loaded">
                                                        <div class="loader"></div>
                                                        <p class="m-0">Loading products...</p>
                                                    </div>
                                                    <div align="center" v-if="!hasProducts && loaded">
                                                        <h4 class="m-0"><i class="material-icons">error</i></h4>
                                                        <p class="mb-3">An error occurred, try again!</p>
                                                        <a href="javascript:void(0)" class="btn btn-success btn-pill" @click="fetchOrderProducts"><i class="fa fa-refresh"></i> Refresh</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                        <template v-else-if="hasProducts && loaded">
                                            <tr class="row-2" v-for="(product, indx) in products" :key="indx">
                                                <td class="row-img lo-stats__image">
                                                    <img class="border rounded" :src="product.images[0].url" alt="product-img">
                                                </td>
                                                <td class="product-name"><a :href="'/products/' + product.code">{{ product.name }}</a></td>
                                                <td class="product-price">{{ product.currencyCode }} {{ product.pivot.price }}</td>
                                                <td class="product-quantity">{{ product.pivot.quantity }}</td>
                                                <td class="product-subtotal">{{ product.currencyCode }} {{ product.pivot.sum }}</td>
                                                <td class="border-right-0">
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-sm btn-white"><i class="material-icons">check</i> Confirm Receipt</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                        </tbody>
                                        <tfoot>
                                        <tr class="row-6">
                                            <td class="text-left border-bottom-0" colspan="4">Order Total</td>
                                            <td class="product-subtotal border-bottom-0">{{ order.currencyCode }} {{ order.sum }}</td>
                                            <td class="border-0"></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        name: "MyOrderDetails",
        mounted(){
            this.fetchOrderProducts();
        },
        data() {
            return {
                products: [],
                page: 1,
                loaded: false,
                paginatorInfo: null,
            }
        },
        props: {
            order: {
                type: Object,
                required: true
            }
        },
        computed: {
            hasProducts() {
                return this.products.length > 0;
            }
        },
        methods: {
            fetchOrderProducts() {
                this.loaded = false;
                axios.post(graphql.api, {
                    query: graphql.myOrderProducts,
                    variables: {id: this.order.id, page: this.page, count: graphql.rowCount}
                }).then(this.loadOrderProducts).catch(function (error) {});
            },
            loadOrderProducts(response) {
                this.loaded = true;
                this.products = response.data.data.order.products.data;
                this.paginatorInfo = response.data.data.order.products.paginatorInfo;
            },
            loadPage(page) {
                this.page = page;
                this.fetchOrderProducts();
            }
        }
    }
</script>

<style scoped>

</style>