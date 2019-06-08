<template>
    <div>
        <a class="btn btn-white mb-2" href="javascript:void(0)" @click="transitionBack">
            <i class="material-icons">chevron_left</i> Back to orders
        </a>
        <div class="card card-small border" v-if="!loaded || (!hasProducts && loaded)">
            <div class="card-body">
                <div align="center" v-if="!loaded">
                    <div class="loader"></div>
                    <p class="m-0">Loading products...</p>
                </div>
                <div align="center" v-if="!hasProducts && loaded">
                    <h4 class="m-0"><i class="material-icons">error</i></h4>
                    <p class="mb-3">An error occurred, try again!</p>
                    <a href="javascript:void(0)" class="btn btn-success btn-pill" @click="fetchOrderProducts"><i class="fa fa-refresh"></i> Refresh</a>
                </div>
            </div>
        </div>
        <template v-else-if="hasProducts && loaded">
            <section class="cart-section card border">
                <div class="row">
                    <div class="col-md-12">
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
                    </div>
                </div>
            </section>
        </template>
        <pagination v-if="paginatorInfo" class="my-2" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
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
                currencyCode: ''
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
                this.products = response.data.data.order.products.data;
                if (!this.shop) {
                    this.sum = response.data.data.order.sum;
                    this.currencyCode = response.data.data.order.currencyCode;
                }
                this.paginatorInfo = response.data.data.order.products.paginatorInfo;
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
        }
    }
</script>

<style scoped>

</style>