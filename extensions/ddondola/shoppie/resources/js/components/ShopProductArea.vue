<template>
    <div class="directory-area">
        <div class="card card-small main">
            <div class="card-header p-0 border-bottom bg-light">
                <div class="row">
                    <div class="col-md-11 pr-0">
                        <header class="d-flex justify-content-between align-items-start ml-2" style="margin-top: .6rem !important; margin-bottom: .6rem !important;">
                            <visible-items :paginator-info="paginatorInfo" v-if="showProducts && loaded && paginatorInfo"></visible-items>
                            <span class="visible-items" v-else></span>
                            <div class="d-flex">
                                <select class="form-control form-control-sm custom-select custom-select-sm mr-2" tabindex="-98" v-model="ordering">
                                    <option value="latest">Latest</option>
                                    <option value="oldest">Oldest</option>
                                    <option value="lowest-price">Lowest Price</option>
                                    <option value="highest-price">Highest Price</option>
                                </select>
                                <a :href="newProductUrl" class="btn btn-sm btn-success ml-auto" v-if="admin">
                                    <i class="material-icons">add</i> New Product
                                </a>
                            </div>
                        </header>
                    </div>
                </div>
            </div>
            <div class="card-body h-100" :class="{'bg-white': showProducts && loaded}">
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
                <div class="px-2" v-else-if="showProducts && loaded">
                    <ul class="products">
                        <li :id="indx" is="directory-product" v-for="(product, indx) in products" :key="indx" :product="product" :class="{'first': first(indx + 1), 'last': last(indx + 1)}"></li>
                    </ul>
                </div>
                <pagination v-if="paginatorInfo" class="my-2" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
            </div>
        </div>
    </div>
</template>

<script>
    import DirectoryProduct from "./products/DirectoryProduct";
    export default {
        name: "ShopProductArea",
        components: {DirectoryProduct},
        mounted() {
            this.fetchProducts();
            this.listen();
        },
        data() {
            return {
                products: [],
                loaded: false,
                page: 1,
                ordering: '',
                paginatorInfo: null,
                brandIds: [],
                subCategoryIds: [],
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
                return '/shops/' + this.shop + '/inventory/new-product';
            },
            showProducts() {
                return this.products.length > 0;
            },
            filters() {
                return {
                    ordering: this.ordering,
                    brandIds: JSON.stringify(this.brandIds),
                    subCategoryIds: JSON.stringify(this.subCategoryIds)
                }
            }
        },
        methods: {
            fetchProducts() {
                this.products = [];
                this.loaded = false;
                axios.post(graphql.api, {
                    query: graphql.shopProducts,
                    variables: {shop: this.shop, filters: this.filters, count: graphql.columnCount, page: this.page}
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
                Bus.$on("filter-products", this.filterProducts);
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
            filterProducts(filter) {

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
    .directory-area .card.main {
        height: calc(99.9vh - 7.05rem - 1px) !important;
    }
</style>