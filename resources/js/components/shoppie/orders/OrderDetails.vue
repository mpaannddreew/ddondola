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
                                <a class="btn btn-white btn-sm text-danger" href="javascript:void(0)" @click="transitionBack">
                                    <i class="material-icons">clear</i>
                                </a>
                            </div>
                            <div class="col-12 col-sm-6 d-flex align-items-center">
                                <div class="ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0">
                                    <a class="btn btn-white btn-sm" href="javascript:void(0)" v-if="!shop">
                                        <i class="material-icons">description</i> Invoice
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
                            <div class="order-block" v-if="!shop">
                                <div class="order-icon">
                                    <i class="material-icons">info_outline</i>
                                </div>
                                <div class="_status">
                                    <div>Status</div>
                                    <div><span class="badge badge-info">Shipping</span></div>
                                </div>
                            </div>
                            <!-- Order date -->
                            <div class="order-block">
                                <div class="order-icon">
                                    <i class="material-icons">date_range</i>
                                </div>
                                <div class="date">
                                    <div>Date</div>
                                    <div class="is-date">{{ loadedOrder.created_at|time }}</div>
                                </div>
                            </div>
                            <!-- Order total -->
                            <div class="order-block" v-if="!shop">
                                <div class="order-icon">
                                    <i class="material-icons">attach_money</i>
                                </div>
                                <div class="total">
                                    <div>Order total</div>
                                    <div class="is-price">{{ currencyCode }} {{ sum }} <span class="badge badge-success">Paid</span></div>
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
                                            <tr class="cart-item" v-for="(product, indx) in products" :key="indx">
                                                <td class="row-img lo-stats__image" :class="{'border-bottom-0': shop}">
                                                    <img class="border rounded" :src="product.images[0].url" alt="product-img">
                                                </td>
                                                <td class="product-name" :class="{'border-bottom-0': shop}"><a :href="'/products/' + product.code">{{ product.name }}</a></td>
                                                <td class="product-price" :class="{'border-bottom-0': shop}">{{ product.currencyCode }} {{ product.pivot.price }}</td>
                                                <td class="product-quantity" :class="{'border-bottom-0': shop}">{{ product.pivot.quantity }}</td>
                                                <td class="product-subtotal" :class="{'border-bottom-0': shop}">{{ product.currencyCode }} {{ product.pivot.sum }}</td>
                                                <td class="row-close close-2">
                                                    <div class="btn-group btn-group-sm ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" role="group">
                                                        <a href="javascript:void(0)" class="btn btn-white text-success">
                                                            <i class="material-icons">check</i>
                                                        </a>
                                                        <a href="javascript:void(0)" class="btn btn-white text-danger">
                                                            <i class="material-icons">clear</i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                        <tr class="row-6" v-if="!shop">
                                            <td class="text-left border-bottom-0 text-uppercase" colspan="4">Order Total</td>
                                            <td class="product-subtotal border-0 text-muted">{{ currencyCode }} {{ sum }}</td>
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
    export default {
        name: "OrderDetails",
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
                    return '/shops/' + this.shop + '/orders';
                }

                return '/me/orders';
            },
            messengerUrl() {
                if (this.loaded) {
                    return '/shops/' + this.shop + '/messenger/' + this.buyer.code;
                }

                return null;
            },
            buyerAvatar() {
                if (this.loaded) {
                    return this.buyer.avatar.url;
                }

                return null;
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
            transitionBack() {
                this.$router.push(this.ordersRoute);
            }
        },
        watch: {
            '$route': 'fetchOrderProducts'
        },
        filters: {
            time(date) {
                if (Moment().isSame(Moment(date), 'd'))
                    return Moment(date).format("h:mm a");

                if (Moment().subtract(1, 'days').isSame(Moment(date), 'd'))
                    return 'Yesterday';

                return Moment(date).format("MM/DD/YY");
            }
        }
    }
</script>

<style scoped>

</style>