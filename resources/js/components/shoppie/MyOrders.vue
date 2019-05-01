<template>
    <div>
        <div class="container py-2">
            <div class="mb-2">
                <div class="row no-gutters">
                    <div class="col-lg-6 mb-2 mb-lg-0">
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
                    <div class="col">
                        <div class="d-flex ml-lg-auto my-auto">
                            <div class="btn-group btn-group-sm ml-lg-auto" role="group" aria-label="Table row actions">
                                <div class="btn-group">
                                    <select class="form-control form-control-sm custom-select custom-select-sm" tabindex="-98" v-model="showing">
                                        <option value="all">All</option>
                                        <option value="pending">Pending</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-small lo-stats h-100 border mt-2">
                <table class="table mb-0">
                    <thead class="py-2 bg-light text-semibold border-bottom">
                    <tr>
                        <th>Details</th>
                        <th></th>
                        <th class="text-center">Items</th>
                        <th class="text-center">Total</th>
                        <th class="text-right"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-if="!loaded || (!hasOrders && loaded)">
                        <tr>
                            <td colspan="6">
                                <div align="center" v-if="!loaded">
                                    <div class="loader"></div>
                                    <p class="m-0">Loading orders...</p>
                                </div>
                                <div align="center" v-if="!hasOrders && loaded">
                                    <h4 class="m-0"><i class="material-icons">error</i></h4>
                                    <p class="m-0">You have not placed any orders yet!</p>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <template v-else-if="hasOrders && loaded">
                        <template v-for="(order, indx) in orders">
                            <tr is="my-order" :order="order" :key="indx"></tr>
                            <tr is="my-order-details" :order="order" :key="indx + '_' + order.id" v-if="isActive(order.id)"></tr>
                        </template>
                    </template>
                    </tbody>
                </table>
            </div>
            <pagination v-if="paginatorInfo" class="my-2" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
        </div>
    </div>
</template>

<script>
    import MyOrder from "./orders/MyOrder";
    import MyOrderDetails from "./orders/MyOrderDetails";
    export default {
        name: "MyOrders",
        components: {MyOrderDetails, MyOrder},
        mounted() {
            this.fetchOrders();
            this.listen();
        },
        data() {
            return {
                orders: [],
                page: 1,
                loaded: false,
                showing: 'all',
                paginatorInfo: null,
                activeOrder: null
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
                    query: graphql.myOrders,
                    variables: {page: this.page, count: graphql.rowCount}
                }).then(this.loadOrders).catch(function (error) {});
            },
            loadOrders(response) {
                this.loaded = true;
                this.orders = response.data.data.me.orders.data;
                this.paginatorInfo = response.data.data.me.orders.paginatorInfo;
            },
            loadPage(page) {
                Bus.$emit('active', null);
                this.page = page;
                this.fetchOrders();
            },
            isActive(id) {
                return this.activeOrder === id;
            },
            listen() {
                Bus.$on('active', this.changeActive);
            },
            changeActive(id) {
                this.activeOrder = id;
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