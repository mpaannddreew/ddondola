<template>
    <div class="directory-area">
        <div class="card card-small main">
            <div class="card-header py-0 border-bottom bg-light">
                <header class="d-flex justify-content-between align-items-start ml-2" style="margin-top: .6rem !important; margin-bottom: .6rem !important;">
                    <visible-items :paginator-info="paginatorInfo" v-if="showProducts && loaded && paginatorInfo"></visible-items>
                    <span class="visible-items" v-else></span>
                    <div class="d-flex">
                        <div class="btn-group btn-group-sm btn-group-toggle d-inline-flex mb-4 mb-sm-0 mx-auto" role="group" aria-label="Page actions">
                            <a href="javascript:void(0)" @click="showGrid" class="btn btn-white" :class="{active: grid}"><i class="material-icons">view_module</i></a>
                            <a href="javascript:void(0)" @click="showList" class="btn btn-white" :class="{active: !grid}"><i class="material-icons">view_list</i></a>
                        </div>
                        <div class="ml-auto d-flex">
                            <select class="form-control form-control-sm custom-select custom-select-sm mx-2" tabindex="-98" v-model="ordering">
                                <option value=""></option>
                                <option value="latest">Latest</option>
                                <option value="oldest">Oldest</option>
                                <option value="lowest-price">Lowest Price</option>
                                <option value="highest-price">Highest Price</option>
                            </select>
                            <a :href="newProductUrl" class="btn btn-sm btn-success ml-auto" v-if="admin">
                                <i class="fa fa-plus"></i> Add Product
                            </a>
                        </div>
                    </div>
                </header>
            </div>
            <div class="card-body h-100" :class="{'bg-white': showProducts && loaded && grid}">
                <div class="center-xy" v-if="!loaded || (!showProducts && loaded)">
                    <div align="center" v-if="!loaded">
                        <div class="loader"></div>
                        <p class="m-0">Loading products...</p>
                    </div>
                    <div align="center" v-if="!showProducts && loaded">
                        <h4 class="m-0"><i class="material-icons">error</i></h4>
                        <p class="m-0">There are no products in this shop yet!</p>
                    </div>
                </div>
                <div class="px-2" v-else-if="showProducts && loaded && grid">
                    <ul class="products">
                        <li :id="indx" is="directory-product" v-for="(product, indx) in products" :key="indx" :product="product" :class="{'first': first(indx + 1), 'last': last(indx + 1)}"></li>
                    </ul>
                </div>
                <div class="card card-small lo-stats border-top-radius-0" style="border-top: 0 !important;"  v-else-if="showProducts && loaded && !grid">
                    <table class="table mb-0">
                        <thead class="py-2 bg-light text-semibold">
                        <tr>
                            <th class="border-top-0">Details</th>
                            <th class="border-top-0"></th>
                            <th class="border-top-0">Brand</th>
                            <th class="border-top-0">Category</th>
                            <th class="border-top-0">Subcategory</th>
                            <th class="border-top-0">Price</th>
                            <th class="text-right border-top-0"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr is="product-row" v-for="(product, indx) in products" :key="indx" :product="product"></tr>
                        </tbody>
                    </table>
                </div>
                <pagination v-if="paginatorInfo" class="my-2" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
            </div>
        </div>
    </div>
</template>

<script>
    import DirectoryProduct from "./products/DirectoryProduct";
    import ProductRow from "./products/ProductRow";
    export default {
        name: "ShopProductArea",
        components: {ProductRow, DirectoryProduct},
        mounted() {
            this.fetchProducts();
            this.listen();
        },
        data() {
            return {
                grid: true,
                products: [],
                loaded: false,
                page: 1,
                ordering: '',
                paginatorInfo: null,
                brandIds: [],
                subCategoryIds: [],
                searchFilter: ''
            }
        },
        props: {
            admin: {
                type: Boolean,
                default: false
            },
            shop: {
                type: String,
                required: true
            }
        },
        computed: {
            newProductUrl() {
                return `/shops/${this.shop}/inventory/new-product`;
            },
            showProducts() {
                return this.products.length > 0;
            },
            filters() {
                return {
                    ordering: this.ordering,
                    brandIds: JSON.stringify(this.brandIds),
                    subCategoryIds: JSON.stringify(this.subCategoryIds),
                    name: this.searchFilter
                }
            },
            variables() {
                return {shop: this.shop, inventory: false, filters: this.filters, count: graphql.columnCount, page: this.page};
            }
        },
        methods: {
            showGrid() {
                this.grid = true;
            },
            showList() {
                this.grid = false;
            },
            fetchProducts() {
                this.products = [];
                this.loaded = false;
                axios.post(graphql.api, {
                    query: graphql.shopProducts,
                    variables: this.variables
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
            },
            first(indx) {
                return indx % 3 === 1;
            },
            last(indx) {
                return indx % 3 === 0;
            },
            listen() {
                Bus.$on("sub-category-ids", this.showFromSubcategory);
                Bus.$on("brand-ids", this.showFromBrands);
                Bus.$on("filter-changed", this.filterChanged);
            },
            showFromSubcategory(ids) {
                this.subCategoryIds = ids;
                this.brandIds = [];
                this.loadPage(1);
            },
            showFromBrands(ids) {
                this.brandIds = ids;
                this.subCategoryIds = [];
                this.loadPage(1);
            },
            filterChanged(filter) {
                this.searchFilter = filter;
            }
        },
        watch: {
            ordering(data) {
                this.loadPage(1);
            },
            searchFilter: _.debounce(function(data) {
                this.loadPage(1);
            }, 1000)
        }
    }
</script>

<style scoped>
    .directory-area .card.main {
        height: calc(99.9vh - 7.05rem - 1px) !important;
    }
</style>