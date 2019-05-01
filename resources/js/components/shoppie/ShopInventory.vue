<template>
    <div>
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
                                <input type="text" class="form-control form-control-sm" placeholder="Filter products">
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <div class="d-flex ml-lg-auto my-auto">
                            <div class="btn-group btn-group-sm ml-lg-auto" role="group" aria-label="Table row actions">
                                <div class="btn-group">
                                    <select class="form-control form-control-sm custom-select custom-select-sm" tabindex="-98" v-model="ordering">
                                        <option value="newest">Latest</option>
                                        <option value="oldest">Oldest</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="lowest-price">Lowest price</option>
                                        <option value="highest-price">Highest price</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-small lo-stats h-100 mb-4 border border-top-radius-0">
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
                        <th class="text-center">Price</th>
                        <th class="text-right"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-if="!loaded || (!showProducts && loaded)">
                        <tr>
                            <td colspan="9">
                                <div align="center" v-if="!loaded">
                                    <div class="loader"></div>
                                    <p class="m-0">Loading products...</p>
                                </div>
                                <div align="center" v-if="!showProducts && loaded">
                                    <h4 class="m-0"><i class="material-icons">error</i></h4>
                                    <p class="m-0">You have not added any products yet!</p>
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
            <pagination v-if="paginatorInfo" class="my-2" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
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
                page: 1,
                ordering: '',
                paginatorInfo: null
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
                this.products = [];
                this.loaded = false;
                axios.post(graphql.api, {
                    query: graphql.shopProducts,
                    variables: {shopId: this.shop.id, filters: {ordering: this.ordering}, count: graphql.rowCount, page: this.page}
                }).then(this.loadProducts).catch(function (error) {});
            },
            loadProducts(response) {
                this.loaded = true;
                this.products = response.data.data.shop.products.data;
                this.paginatorInfo = response.data.data.shop.products.paginatorInfo;
            },
            loadPage(page) {
                this.page = page;
                this.fetchProducts();
            }
        },
        watch: {
            ordering(data) {
                this.loadPage(1);
            }
        }
    }
</script>

<style scoped>

</style>