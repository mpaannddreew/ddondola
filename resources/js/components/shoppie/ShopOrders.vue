<template>
    <div class="directory-list close-directory-list">
        <div class="card card-small h-100 border-right main">
            <div class="card-header border-bottom border-top-radius-0 bg-light" style="padding-top: 0.525rem; padding-bottom: 0.525rem;">
                <div class="input-group input-group-seamless">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <input class="form-control" type="text" placeholder="Filter orders" aria-label="Search" v-model="searchFilter">
                </div>
            </div>
            <div class="card-body h-100">
                <div class="center-xy" v-if="!loaded || (!hasOrders && loaded)">
                    <div align="center" v-if="!loaded">
                        <div class="loader"></div>
                        <p class="m-0">Loading orders...</p>
                    </div>
                    <div align="center" v-if="!hasOrders && loaded">
                        <h4 class="m-0"><i class="material-icons">error</i></h4>
                        <p class="m-0">You have not received any orders yet!</p>
                    </div>
                </div>
                <div class="flat-card is-auto list-card" v-else-if="hasOrders && loaded">
                    <!--<div class="list-card-header">-->
                        <!--Orders List-->
                    <!--</div>-->
                    <!-- List -->
                    <div class="list-group">
                        <!-- List item -->
                        <template v-for="(order, indx) in orders">
                            <shop-order :order="order" :key="indx"></shop-order>
                        </template>
                    </div>
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
            this.listen();
            this.fetchOrders();
        },
        data() {
            return {
                orders: [],
                page: 1,
                loaded: false,
                paginatorInfo: null,
                searchFilter: ''
            }
        },
        computed: {
            hasOrders() {
                return this.orders.length > 0;
            },
            variables() {
                var variables = {shop: this.$route.params.shop, page: this.page, count: graphql.rowCount};
                if (this.searchFilter) {
                    variables['search'] = this.searchFilter;
                }

                return variables;
            }
        },
        methods: {
            listen() {
                Echo.private(`shop.${this.$route.params.shop}`)
                    .listen('.new.order', (e) => {
                        if (!this.searchFilter) {
                            this.loadPage(1);
                        }
                    });
            },
            fetchOrders() {
                this.loaded = false;
                axios.post(graphql.api, {
                    query: graphql.shopOrders,
                    variables: this.variables
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
            },
            searchFilter: _.debounce(function (data) {
                this.loadPage(1);
            }, 1000)
        }
    }
</script>

<style scoped>

</style>