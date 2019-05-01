<template>
    <tr>
        <td colspan="5" class="bg-dark-50 py-0">
            <div class="card card-small border-right border-left" style="border-radius: 0px;">
                <div class="card-header border-bottom py-1">
                    <h6 class="m-0">Order Details</h6>
                    <div class="block-handle"></div>
                </div>
            </div>
            <table class="table mb-0 border-right border-left">
                <thead class="py-2 bg-light text-semibold border-bottom">
                <tr>
                    <th>Details</th>
                    <th></th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Items</th>
                    <th class="text-center">Total</th>
                    <th class="text-right"></th>
                </tr>
                </thead>
                <tbody>
                <template v-if="!loaded">
                    <tr>
                        <td colspan="6">
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
                    <tr v-for="(product, indx) in products" :key="indx">
                        <td class="lo-stats__image">
                            <img class="border rounded" :src="product.images[0].url">
                        </td>
                        <td class="lo-stats__order-details">
                            <span>{{ product.name }}</span>
                            <span>{{ product.code }}</span>
                        </td>
                        <td class="lo-stats__status">
                            <div class="d-table mx-auto">
                                <span class="badge badge-pill badge-success">Complete</span>
                            </div>
                        </td>
                        <td class="lo-stats__items text-center">{{ product.pivot.quantity }}</td>
                        <td class="lo-stats__total text-center text-success">{{ product.currencyCode }} {{ product.pivot.price }}</td>
                        <td class="lo-stats__actions">
                            <div class="btn-group d-table ml-auto" role="group">
                                <a href="javascript:void(0)" class="btn btn-sm btn-white" title=""><i class="fa fa-check"></i> Confirm Receipt</a>
                            </div>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
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