<template>
    <div>
        <div>
            <div class="mb-4">
                <div class="row no-gutters">
                    <div class="col-lg-3 mb-2 mb-lg-0">
                        <form action="POST">
                            <div class="input-group input-group-seamless">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="material-icons"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control form-control-sm" placeholder="Filter products">
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <div class="d-flex ml-lg-auto my-auto">
                            <div class="btn-group btn-group-sm ml-lg-auto" role="group" aria-label="Table row actions">
                                <div class="btn-group">
                                    <select class="form-control form-control-sm" tabindex="-98">
                                        <option value="newest">All</option>
                                        <option value="oldest">Active</option>
                                        <option value="lowest-price">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-small lo-stats h-100 mb-4 border">
                <table class="table mb-0">
                    <thead class="py-2 bg-light text-semibold border-bottom">
                    <tr>
                        <th>Details</th>
                        <th></th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Subcategory</th>
                        <th class="text-center">Brand</th>
                        <th class="text-right"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-if="!loaded">
                        <tr><td colspan="8"><div align="center"><div class="loader"></div></div></td></tr>
                    </template>
                    <template v-else-if="!showProducts && loaded">
                        <tr>
                            <td colspan="8">
                                <div align="center">
                                    <h4>
                                        <i class="material-icons">error_outline</i>
                                        <br />
                                        <small>You have not added any products yet!</small>
                                        <br />
                                        <a :href="newProductUrl" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Add Products</a>
                                    </h4>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <template v-else-if="showProducts && loaded">
                        <tr is="inventory-row" v-for="(product, indx) in products" :key="indx" :product="product" :url="url"></tr>
                    </template>
                    </tbody>
                </table>
            </div>
            <nav>
                <ul class="pager">
                    <li class="disabled">
                        <a class="btn btn-block btn-pill btn-outline-primary btn-sm" href="#">
                            <span aria-hidden="true"><i class="fa fa-chevron-left"></i></span> Previous
                        </a>
                    </li>
                    <li class="spacer"></li>
                    <li>
                        <a class="btn btn-block btn-pill btn-outline-primary btn-sm" href="#">
                            Next <span aria-hidden="true"><i class="fa fa-chevron-right"></i></span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
    import InventoryRow from "./inventory/InventoryRow";
    export default {
        name: "ShopInventory",
        components: {InventoryRow},
        mounted() {
            this.fetchProducts();
        },
        data() {
            return {
                products: [],
                loaded: false,
                count: 10,
                page: 1
            }
        },
        computed: {
            showProducts() {
                return this.products.length > 0;
            }
        },
        props: {
            newProductUrl: {
                type: String,
                required: true
            },
            url: {
                type: String,
                required: true
            },
            shop: {
                type: Object,
                required: true
            }
        },
        methods: {
            fetchProducts() {
                axios.post(graphql.api, {
                    query: graphql.shopProducts,
                    variables: {shopId: this.shop.id, count: this.count, page: this.page}
                }).then(this.loadProducts).catch(function (error) {});
            },
            loadProducts(response) {
                this.loaded = true;
                this.products = response.data.data.shop.products.data;
            }
        }
    }
</script>

<style scoped>

</style>