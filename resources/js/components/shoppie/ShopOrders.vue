<template>
    <div>
        <div class="mb-2">
            <div class="row no-gutters">
                <div class="col-lg-6 mb-2 mb-lg-0">
                    <form action="POST">
                        <div class="input-group input-group-seamless">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="material-icons"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control form-control-sm" placeholder="Filter by buyer">
                        </div>
                    </form>
                </div>
                <div class="col d-flex align-items-center">
                    <div class="d-flex ml-lg-auto my-auto">
                        <form action="POST">
                            <div class="input-daterange input-group input-group-md w-100">
                                <input type="text" class="input-sm form-control form-control-sm" name="start" placeholder="Start Date">
                                <input type="text" class="input-sm form-control form-control-sm" name="end" placeholder="End Date">
                                <span class="input-group-append">
                                <span class="input-group-text">
                                      <i class="material-icons">date_range</i>
                                </span>
                            </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-small lo-stats h-100 border mt-2">
            <table class="table mb-0">
                <thead class="py-2 bg-light text-semibold border-bottom">
                <tr>
                    <th>Buyer</th>
                    <th></th>
                    <th class="text-center">Email</th>
                    <th class="text-right"></th>
                </tr>
                </thead>
                <tbody>
                <template v-if="!loaded || (!hasOrders && loaded)">
                    <tr>
                        <td colspan="4">
                            <div align="center" v-if="!loaded">
                                <div class="loader"></div>
                                <p class="m-0">Loading orders...</p>
                            </div>
                            <div align="center" v-if="!hasOrders && loaded">
                                <h4 class="m-0"><i class="material-icons">error</i></h4>
                                <p class="m-0">You have not received any orders yet!</p>
                            </div>
                        </td>
                    </tr>
                </template>
                <template v-else-if="hasOrders && loaded">
                    <template v-for="(order, indx) in orders">
                        <tr is="shop-order" :order="order" :shop="shop" :key="indx"></tr>
                    </template>
                </template>
                </tbody>
            </table>
        </div>
        <pagination v-if="paginatorInfo" class="my-2" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
    </div>
</template>

<script>
    import MyOrder from "./orders/ShopOrder";
    export default {
        name: "ShopOrders",
        components: {MyOrder},
        mounted() {
            this.fetchOrders();
        },
        data() {
            return {
                orders: [],
                page: 1,
                loaded: false,
                paginatorInfo: null,
            }
        },
        props: {
            shop: {
                type: String
            }
        },
        computed: {
            hasOrders() {
                return this.orders.length > 0;
            }
        },
        methods: {
            fetchOrders() {
                this.loaded = false;
                axios.post(graphql.api, {
                    query: graphql.shopOrders,
                    variables: {shop: this.shop, page: this.page, count: graphql.rowCount}
                }).then(this.loadOrders).catch(function (error) {});
            },
            loadOrders(response) {
                this.loaded = true;
                this.orders = response.data.data.shop.orders.data;
                this.paginatorInfo = response.data.data.shop.orders.paginatorInfo;
            },
            loadPage(page) {
                this.page = page;
                this.fetchOrders();
            }
        },
        watch: {
            showing(data) {
                this.loaded = false;
                this.loadPage(1);
            }
        }
    }
</script>

<style scoped>

</style>