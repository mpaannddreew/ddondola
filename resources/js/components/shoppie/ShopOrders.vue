<template>
    <div class="directory-list close-directory-list">
        <div class="card card-small h-100 border-right">
            <div class="card-header border-bottom border-top-radius-0 bg-light" style="padding-top: 0.525rem; padding-bottom: 0.525rem;">
                <div class="input-group input-group-seamless">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <input class="form-control" type="text" placeholder="Filter orders" aria-label="Search">
                </div>
            </div>
            <div class="card-body h-100">
                <div class="flat-card is-auto list-card">
                    <!--<div class="list-card-header">-->
                        <!--Orders List-->
                    <!--</div>-->
                    <template v-if="!loaded || (!hasOrders && loaded)">
                        <div class="p-4">
                            <div align="center" v-if="!loaded">
                                <div class="loader"></div>
                                <p class="m-0">Loading orders...</p>
                            </div>
                            <div align="center" v-if="!hasOrders && loaded">
                                <h4 class="m-0"><i class="material-icons">error</i></h4>
                                <p class="m-0">You have not received any orders yet!</p>
                            </div>
                        </div>
                    </template>
                    <template v-else-if="hasOrders && loaded">
                        <!-- List -->
                        <ul class="p-0">
                            <!-- List item -->
                            <template v-for="(order, indx) in orders">
                                <li is="shop-order" :order="order" :key="indx"></li>
                            </template>
                        </ul>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ShopOrder from "./orders/ShopOrder";
    export default {
        name: "ShopOrders",
        components: {ShopOrder},
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
                    variables: {shop: this.$route.params.shop, page: this.page, count: graphql.rowCount}
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