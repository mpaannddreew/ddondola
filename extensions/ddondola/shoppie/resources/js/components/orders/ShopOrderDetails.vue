<template>
    <div>
        <div class="directory-area">
            <div class="card card-small h-100 main" v-if="!loaded || (!hasProducts && loaded)">
                <div class="card-body">
                    <div class="center-xy">
                        <div align="center" v-if="!loaded">
                            <loader></loader>
                            <p class="m-0">Loading order...</p>
                        </div>
                        <div align="center" v-if="!hasProducts && loaded">
                            <h4 class="m-0"><i class="material-icons">error</i></h4>
                            <p class="mb-3">An error occurred, try again!</p>
                            <a href="javascript:void(0)" class="btn btn-success btn-pill" @click="fetchOrderProducts"><i class="fa fa-refresh"></i> Refresh</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-small main" v-else-if="hasProducts && loaded">
                <div class="card-body h-100">
                    <div class="p-5">
                        <div class="d-flex mb-2 align-items-center">
                            <div>
                                <div class="ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0">
                                    <a class="btn btn-white btn-sm text-danger" href="javascript:void(0)" @click="close">
                                        <i class="material-icons">clear</i>
                                    </a>
                                </div>
                            </div>
                            <div class="ml-auto d-flex align-items-center">
                                <a class="btn btn-white btn-sm" :href="messengerUrl">
                                    <i class="material-icons">chat</i> Message Buyer
                                </a>
                            </div>
                        </div>
                        <div class="flat-card is-auto order-list-card p-4 border bg-white border-radius">
                            <div class="order-block">
                                <div class="order-icon">
                                    <i class="material-icons">description</i>
                                </div>
                                <div class="handled-by">
                                    <div>Order</div>
                                    <div class="text-uppercase">Order #{{ label }}</div>
                                </div>
                            </div>
                            <!-- Orders team member -->
                            <div class="order-block">
                                <img :src="buyerAvatar" alt="">
                                <div class="handled-by">
                                    <div>Buyer</div>
                                    <div>{{ buyer.name }}</div>
                                </div>
                            </div>
                            <!-- Order status -->
                            <div class="order-block">
                                <div class="order-icon">
                                    <i class="material-icons">credit_card</i>
                                </div>
                                <div class="_status">
                                    <div>Payment</div>
                                    <div>
                                        <span class="badge" :class="paymentIndicator">{{ status }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Order date -->
                            <div class="order-block">
                                <div class="order-icon">
                                    <i class="material-icons">access_time</i>
                                </div>
                                <div class="date">
                                    <div>Date</div>
                                    <div class="is-date">{{ loadedOrder.created_at|day }}</div>
                                </div>
                            </div>
                            <!-- Order details -->
                            <section class="cart-section card mt-4">
                                <div class="cart-table table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                        <tr class="row-1" style="border-bottom: 0;">
                                            <th class="row-title"><p>Item</p></th>
                                            <th class="row-title"><p>Product Name</p></th>
                                            <th class="row-title"><p>Price</p></th>
                                            <th class="row-title"><p>Quantity</p></th>
                                            <th class="row-title"><p>Subtotal</p></th>
                                            <th class="row-title"><p></p></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <template v-for="(product, indx) in products">
                                            <tr v-on:updated="fetchOrderProducts" is="order-row"
                                                :key="indx"
                                                :order-paid-for="loadedOrder.paidFor"
                                                :product="product"
                                                :shop="shop"
                                                :order="order">
                                            </tr>
                                        </template>
                                        <tr class="row-7">
                                            <td class="text-left border-bottom-0 text-uppercase" colspan="4">Order Total</td>
                                            <td class="product-subtotal border-0 text-muted">{{ currencyCode }} {{ sum|commas }}</td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                        <pagination v-if="paginatorInfo" class="my-2" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import OrderRow from "./OrderRow";
    export default {
        name: "ShopOrderDetails",
        components: {OrderRow},
        mounted(){
            this.listen();
            this.fetchOrderProducts();
        },
        data() {
            return {
                products: [],
                page: 1,
                loaded: false,
                paginatorInfo: null,
                sum: 0,
                currencyCode: '',
                buyer: null,
                loadedOrder: null,
                details: true
            }
        },
        props: {
            order: {
                type: String,
                required: true
            },
            shop: {
                type: String
            }
        },
        computed: {
            channel() {
                return `order.${this.shop}.${this.order}`;
            },
            depositAmount() {
                if (this.buyer.accountBalance > this.sum || this.loadedOrder.paidFor || this.loadedOrder.cancelled) {
                    return 0;
                }

                return this.sum - this.buyer.accountBalance;
            },
            status() {
                if (!this.loadedOrder.cancelled)
                    return this.loadedOrder.paidFor ? 'Paid': 'Unpaid';

                return 'Cancelled';
            },
            hasProducts() {
                return this.products.length > 0;
            },
            variables() {
                return {order: this.order, page: this.page, count: graphql.rowCount, shop: this.shop};
            },
            ordersRoute() {
                return `/shops/${this.shop}/orders`;
            },
            messengerUrl() {
                if (this.loaded) {
                    return `/shops/${this.shop}/messenger/${this.buyer.code}`;
                }

                return null;
            },
            buyerAvatar() {
                if (this.loaded) {
                    return this.buyer.avatar.url;
                }

                return null;
            },
            label() {
                return _.head(_.split(this.loadedOrder.code, '-'));
            },
            paymentIndicator() {
                if (this.loadedOrder) {
                    return {
                        'badge-warning': !this.loadedOrder.paidFor,
                        'badge-success': this.loadedOrder.paidFor,
                        'badge-danger': this.loadedOrder.cancelled
                    };
                }

                return {};
            }
        },
        methods: {
            listen() {
                Echo.private(this.channel)
                    .listen('.order.updated', (e) => {
                        this.fetchOrderProducts();
                    });
            },
            fetchOrderProducts() {
                this.loaded = false;
                axios.post(graphql.api, {
                    query: graphql.orderProducts,
                    variables: this.variables
                }).then(this.loadOrderProducts).catch(function (error) {});
            },
            loadOrderProducts(response) {
                this.loaded = true;
                this.loadedOrder = response.data.data.order;
                this.products = this.loadedOrder.products.data;
                this.sum = this.loadedOrder.activeSum;
                this.currencyCode = this.loadedOrder.currencyCode;
                this.buyer = this.loadedOrder.by;
                this.paginatorInfo = this.loadedOrder.products.paginatorInfo;
            },
            loadPage(page) {
                this.page = page;
                this.fetchOrderProducts();
            },
            close() {
                this.$router.push(this.ordersRoute);
            }
        },
        watch: {
            '$route': 'fetchOrderProducts'
        }
    }
</script>

<style scoped>

</style>