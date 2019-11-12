<template>
    <div>
        <div class="products-grid p-0">
            <div class="card border-top-radius-0" style="background: none !important;">
                <div class="card-header p-2 border-bottom bg-white">
                    <div class="container">
                        <header class="d-flex justify-content-between align-items-start m-0">
                            <visible-items :paginator-info="paginatorInfo" v-if="showProducts && loaded && paginatorInfo"></visible-items>
                            <span class="visible-items" v-else></span>
                            <div class="btn-group">
                                <select class="form-control custom-select custom-select-sm" tabindex="-98" v-model="ordering">
                                    <option value="latest">Latest</option>
                                    <option value="oldest">Oldest</option>
                                    <option value="lowest-price">Lowest Price</option>
                                    <option value="highest-price">Highest Price</option>
                                </select>
                            </div>
                        </header>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="card card-small border" v-if="!loaded || (!showProducts && loaded)">
                            <div class="card-body">
                                <div align="center" v-if="!loaded">
                                    <div class="loader"></div>
                                    <p class="m-0">{{ loadingMessage }}</p>
                                </div>
                                <div align="center" v-else-if="!showProducts && loaded">
                                    <h4 class="m-0"><i class="material-icons">error</i></h4>
                                    <p class="m-0">{{ noProductsMessage }}</p>
                                </div>
                            </div>
                        </div>
                        <template v-else-if="showProducts && loaded">
                            <ul class="directory-products border-left">
                                <li is="directory-product" v-for="(product, indx) in products" :key="indx" :product="product"  class="directory-product"></li>
                            </ul>
                        </template>
                        <pagination v-if="paginatorInfo" class="my-4" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Product from "./products/Product";
    import DirectoryProduct from "./products/DirectoryProduct";
    export default {
        name: "WishList",
        components: {DirectoryProduct, Product},
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
        props: {
            myFavorites: {
                type: Boolean,
                required: false,
                default: false
            }
        },
        computed: {
            showProducts() {
                return this.products.length > 0;
            },
            query() {
                return graphql.myFavoriteProducts;
            },
            loadingMessage() {
                return "Loading your wishlist..."
            },
            noProductsMessage() {
                return "Your wishlist is empty!"
            }
        },
        methods: {
            fetchProducts() {
                this.loaded = false;
                this.products = [];
                axios.post(graphql.api, {
                    query: this.query,
                    variables: {count: graphql.columnCount, filters: {ordering: this.ordering}, page: this.page}
                }).then(this.loadProducts).catch(function (error) {});
            },
            loadProducts(response) {
                this.loaded = true;
                this.products = response.data.data.me.products.data;
                this.paginatorInfo = response.data.data.me.products.paginatorInfo;
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