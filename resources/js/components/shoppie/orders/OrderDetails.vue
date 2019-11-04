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
                                <quick-wallet :deposit="true" :deposit-amount="depositAmount" v-if="!shop && !loadedOrder.paidFor && !loadedOrder.cancelled"></quick-wallet>
                                <div class="ml-1 mr-auto mr-sm-0 mt-3 mt-sm-0">
                                    <template v-if="!shop">
                                        <a class="btn btn-white btn-sm" href="javascript:void(0)"
                                           v-if="!loadedOrder.paidFor && !loadedOrder.cancelled" @click="approvePayment">
                                            <i class="fa fa-check"></i> Approve Payment
                                        </a>
                                        <a class="btn btn-white btn-sm" href="javascript:void(0)" @click="showInvoice">
                                            <i class="material-icons">description</i> Invoice
                                        </a>
                                    </template>
                                    <a class="btn btn-white btn-sm" :href="messengerUrl" v-if="shop">
                                        <i class="material-icons">chat</i> Message Buyer
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="flat-card is-auto order-list-card p-4 border bg-white border-radius">
                            <div class="progress-block">
                                <!-- Title -->
                                <h3 class="text-uppercase">ORDER #{{ label }}</h3>
                            </div>
                            <!-- Orders team member -->
                            <div class="order-block" v-if="shop">
                                <img :src="buyerAvatar" alt="">
                                <div class="handled-by">
                                    <div>Placed by</div>
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
                                        <span class="badge" :class="{'badge-warning': !loadedOrder.paidFor, 'badge-success': loadedOrder.paidFor, 'badge-danger': loadedOrder.cancelled}">{{ status }}</span>
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
                                    <div class="is-date">{{ loadedOrder.created_at|timeSpecific }}</div>
                                </div>
                            </div>
                            <!-- Order total -->
                            <div class="order-block" v-if="!shop">
                                <div class="order-icon">
                                    <i class="material-icons">attach_money</i>
                                </div>
                                <div class="total">
                                    <div>Order total</div>
                                    <div class="is-price">{{ currencyCode }} {{ sum|commas }}</div>
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
        name: "OrderDetails",
        components: {OrderRow},
        mounted(){
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
                var variables = {order: this.order, page: this.page, count: graphql.rowCount};
                if (this.shop) {
                    variables["shop"] = this.shop;
                }

                return variables;
            },
            ordersRoute() {
                if (this.shop) {
                    return `/shops/${this.shop}/orders`;
                }

                return '/me/orders';
            },
            invoiceRoute() {
                return `${this.ordersRoute}/${this.order}/invoice`
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
            }
        },
        methods: {
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
                this.sum = this.loadedOrder.sum;
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
            },
            showInvoice() {
                this.$router.push(this.invoiceRoute);
            },
            approvePayment() {
                axios.post(graphql.api, {
                    query: graphql.approvePayment,
                    variables: {order: this.loadedOrder.id}
                }).then(this.paymentApproved).catch(function (e) {});
            },
            paymentApproved(response) {

            }
        },
        watch: {
            '$route': 'fetchOrderProducts'
        }
    }
</script>

<style scoped>

</style>