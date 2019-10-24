<template>
    <div class="directory-area">
        <div class="card card-small main">
            <div class="card-header p-0 border-bottom bg-light">
                <header class="d-flex justify-content-between align-items-start" style="margin: .6rem !important;">
                    <visible-items :paginator-info="paginatorInfo" v-if="showProducts && loaded && paginatorInfo"></visible-items>
                    <span class="visible-items" v-else></span>
                    <div class="d-flex">
                        <div class="btn-group btn-group-sm btn-group-toggle d-inline-flex mb-4 mb-sm-0 mx-auto" role="group" aria-label="Page actions">
                            <a href="javascript:void(0)" @click="showGrid" class="btn btn-white" :class="{active: grid}"><i class="material-icons">view_module</i></a>
                            <a href="javascript:void(0)" @click="showList" class="btn btn-white" :class="{active: !grid}"><i class="material-icons">view_list</i></a>
                        </div>
                        <select class="form-control form-control-sm custom-select custom-select-sm mx-2" tabindex="-98" v-model="ordering">
                            <option value=""></option>
                            <option value="latest">Latest</option>
                            <option value="oldest">Oldest</option>
                            <option value="lowest-price">Lowest Price</option>
                            <option value="highest-price">Highest Price</option>
                        </select>
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
                        <p class="m-0">There are no products in the directory yet!</p>
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
        name: "ProductDirectoryArea",
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
                categoryIds: [],
                searchFilter: ''
            }
        },
        computed: {
            showProducts() {
                return this.products.length > 0;
            },
            filters() {
                return {categoryIds: JSON.stringify(this.categoryIds), ordering: this.ordering, name: this.searchFilter}
            },
            variables() {
                return {count: graphql.columnCount, filters: this.filters, page: this.page};
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
            },
            first(indx) {
                return indx % 3 === 1;
            },
            last(indx) {
                return indx % 3 === 0;
            },
            listen() {
                Bus.$on('category-ids', this.showFromCategory);
                Bus.$on('directory-filter', this.filterChanged);
            },
            showFromCategory(ids) {
                this.categoryIds = ids;
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

</style>