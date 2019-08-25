<template>
    <div>
        <div class="directory-area">
            <div class="card card-small h-100 main" v-if="!loaded || (!hasProducts && loaded)">
                <div class="card-body">
                    <div class="center-xy">
                        <div align="center" v-if="!loaded">
                            <div class="loader"></div>
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
                        <div class="row mb-2">
                            <div class="col-12 col-sm-6 text-center text-sm-left mb-4 mb-sm-0">
                                <a class="btn btn-white btn-sm text-danger" href="javascript:void(0)" @click="close">
                                    <i class="material-icons">clear</i>
                                </a>
                            </div>
                            <div class="col-12 col-sm-6 d-flex align-items-center">
                                <div class="ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0">
                                    <a class="btn btn-white btn-sm" href="javascript:void(0)" v-if="!shop" @click="showInvoice">
                                        <i class="material-icons">description</i> Invoice
                                    </a>
                                    <a class="btn btn-white btn-sm" href="javascript:void(0)" v-if="!shop && !loadedOrder.paidFor">
                                        <i class="material-icons">credit_card</i> Make Payment
                                    </a>
                                    <a class="btn btn-white btn-sm" :href="messengerUrl" v-if="shop">
                                        <i class="material-icons">chat</i> Message Buyer
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="flat-card is-auto order-list-card p-4 border bg-white border-radius">
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
                                        <span class="badge" :class="{'badge-warning': !loadedOrder.paidFor, 'badge-success': loadedOrder.paidFor}">{{ status }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Order date -->
                            <div class="order-block">
                                <div class="order-icon">
                                    <i class="material-icons">date_range</i>
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
                                            <tr is="order-row" :key="indx" :order-paid-for="loadedOrder.paidFor" :product="product"></tr>
                                        </template>
                                        <tr class="row-6" v-if="!shop">
                                            <td class="text-left border-bottom-0 text-uppercase" colspan="4">Order Total</td>
                                            <td class="product-subtotal border-0 text-muted">{{ currencyCode }} {{ sum|commas }}</td>
                                            <td></td>
                                        </tr>
                                        <tr v-else>
                                            <td class="text-left border-bottom-0 text-uppercase" colspan="4"></td>
                                            <td class="product-subtotal border-0 text-muted"></td>
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
            status() {
                return this.loadedOrder.paidFor ? 'Cleared': 'Pending';
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
            ravePublicKey() {
                return RavePublicKey;
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
                if (!this.shop) {
                    this.sum = this.loadedOrder.sum;
                    this.currencyCode = this.loadedOrder.currencyCode;
                }
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
            pay() {
                var x = getpaidSetup({
                    PBFPubKey: this.ravePublicKey,
                    customer_firstname: this.buyer.first_name,
                    customer_lastname: this.buyer.last_name,
                    customer_email: this.buyer.email,
                    amount: 2000,
                    currency: "UGX",
                    txref: "rave-123456",
                    meta: [{
                        metaname: "order",
                        metavalue: this.order
                    }],
                    onclose: function() {},
                    callback: function(response) {
                        var txref = response.tx.txRef;
                        console.log("This is the response returned after a charge", response);
                        if (
                            response.tx.chargeResponseCode == "00" ||
                            response.tx.chargeResponseCode == "0"
                        ) {
                            // redirect to a success page
                        } else {
                            // redirect to a failure page.
                        }

                        x.close(); // use this to close the modal immediately after payment.
                    }
                });
            }
        },
        watch: {
            '$route': 'fetchOrderProducts'
        },
        filters: {
            time(date) {
                let time = Moment(date).format("h:mm a");
                if (Moment().isSame(Moment(date), 'd'))
                    return `Today at ${time}`;

                if (Moment().subtract(1, 'days').isSame(Moment(date), 'd'))
                    return `Yesterday at ${time}`;

                return `${Moment(date).format("dddd, MMMM Do YYYY")} at ${time}`;
            }
        }
    }
</script>

<style scoped>

</style>