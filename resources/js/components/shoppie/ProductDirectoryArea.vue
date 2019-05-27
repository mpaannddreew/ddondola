<template>
    <div class="directory-area">
        <div class="card card-small">
            <div class="card-header p-0 border-bottom bg-light">
                <header class="d-flex justify-content-between align-items-start" style="margin: .6rem !important;">
                    <visible-items :paginator-info="paginatorInfo" v-if="showProducts && loaded && paginatorInfo"></visible-items>
                    <span class="visible-items" v-else></span>
                    <div class="btn-group">
                        <select class="form-control form-control-sm custom-select custom-select-sm" tabindex="-98" v-model="ordering">
                            <option value="latest">Latest</option>
                            <option value="oldest">Oldest</option>
                            <option value="lowest-price">Lowest Price</option>
                            <option value="highest-price">Highest Price</option>
                        </select>
                    </div>
                </header>
            </div>
            <div class="card-body h-100">
                <div class="card card-small lo-stats border-top-radius-0" style="border-top: 0 !important;">
                    <table class="table mb-0">
                        <thead class="py-2 bg-light text-semibold">
                        <tr>
                            <th class="border-top-0">Details</th>
                            <th class="border-top-0"></th>
                            <th class="text-center border-top-0">Availability</th>
                            <th class="text-center border-top-0">Price</th>
                            <th class="text-right border-top-0"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-if="!loaded || (!showProducts && loaded)">
                            <tr>
                                <td colspan="5">
                                    <div align="center" v-if="!loaded">
                                        <div class="loader"></div>
                                        <p class="m-0">Loading products...</p>
                                    </div>
                                    <div align="center" v-if="!showProducts && loaded">
                                        <h4 class="m-0"><i class="material-icons">error</i></h4>
                                        <p class="m-0">There are no products in the directory yet!</p>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <template v-else-if="showProducts && loaded">
                            <tr is="inventory-row" v-for="(product, indx) in products" :key="indx" :product="product" :inventory="false"></tr>
                        </template>
                        </tbody>
                    </table>
                </div>
                <pagination v-if="paginatorInfo" class="my-2" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
            </div>
        </div>
    </div>
</template>

<script>
    import InventoryRow from "./inventory/InventoryRow";
    export default {
        name: "ProductDirectoryArea",
        components: {InventoryRow},
        mounted() {
            this.fetchProducts();
        },
        props: {
            category: {
                type: String,
                required: false
            }
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
            },
            variables() {
                var variables = {count: graphql.columnCount, filters: {ordering: this.ordering}, page: this.page};
                if (this.category) {
                    variables["category"] = this.category
                }

                return variables;
            }
        },
        methods: {
            fetchProducts() {
                this.products = [];
                this.loaded = false;
                axios.post(graphql.api, {
                    query: graphql.products,
                    variables: this.variables
                }).then(this.loadProducts).catch(function (error) {});
            },
            loadProducts(response) {
                this.loaded = true;
                this.products = response.data.data.products.data;
                this.paginatorInfo = response.data.data.products.paginatorInfo;
            },
            loadPage(page) {
                this.page = page;
                this.fetchProducts();
            }
        },
        watch: {
            '$route': 'fetchProducts',
            ordering(data) {
                this.loadPage(1);
            }
        }
    }
</script>

<style scoped>

</style>