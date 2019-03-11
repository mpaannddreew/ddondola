<template>
    <div>
        <div align="center" v-if="!loaded"><div class="loader"></div></div>
        <div align="center" v-else-if="!showProductsArea && loaded">
            <h4>
                <i class="material-icons">error_outline</i>
                <br />
                <template v-if="!admin">
                    <small>This shop has no products listed yet!</small>
                    <br />
                    <a :href="shopsDirectoryUrl" class="btn btn-xs btn-success"><i class="material-icons">folder_open</i> Discover new shops</a>
                </template>
                <template v-else-if="admin">
                    <small>You have not added any products yet!</small>
                    <br />
                    <a :href="newProductUrl" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Add Products</a>
                </template>
            </h4>
        </div>
        <div class="row" v-else-if="showProductsArea && loaded">
            <div class="col-md-3">
                <div class="sidebar">
                    <div class="block border-bottom">
                        <h6 class="text-uppercase mb-3">Product Categories</h6>
                        <ul class="list-unstyled">
                            <li v-for="(category, indx) in categories" :key="indx">
                                <a href="#" class="d-flex justify-content-between align-items-center"><span>{{ category.name }}</span><small>{{ category.productCount }}</small></a>
                                <ul class="list-unstyled">
                                    <li v-for="(subcategory, indx_) in category.categories.data" :key="indx_"> <a href="#">{{ subcategory.name }}</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="block">
                        <h6 class="text-uppercase">Brands </h6>
                        <form action="#">
                            <div class="custom-control custom-checkbox mb-3" v-for="(brand, indx) in brands" :key="indx">
                                <input id="brand0" type="checkbox" name="clothes-brand" class="custom-control-input">
                                <label class="custom-control-label" for="brand0">{{ brand.name }} <small>({{ brand.productCount }})</small></label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="products-grid p-0">
                    <header class="d-flex justify-content-between align-items-start">
                        <span class="visible-items" v-if="showProducts && productsLoaded">Showing <strong>1-15 </strong>of <strong>158 </strong>results</span>
                        <span class="visible-items" v-else></span>
                        <div class="btn-group">
                            <select class="form-control" tabindex="-98" v-model="ordering">
                                <option value="latest">Latest</option>
                                <option value="oldest">Oldest</option>
                                <option value="lowest-price">Low Price</option>
                                <option value="highest-price">High Price</option>
                            </select>
                        </div>
                    </header>
                    <div align="center" v-if="!productsLoaded"><div class="loader"></div></div>
                    <div align="center" v-else-if="!showProducts && productsLoaded">
                        <h4>
                            <i class="material-icons">error_outline</i>
                            <br />
                            <template v-if="!admin">
                                <small>This shop has no products listed yet!</small>
                                <br />
                                <a :href="shopsDirectoryUrl" class="btn btn-xs btn-success"><i class="material-icons">folder_open</i> Discover new shops</a>
                            </template>
                            <template v-else-if="admin">
                                <small>You have not added any products yet!</small>
                                <br />
                                <a :href="newProductUrl" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Add Products</a>
                            </template>
                        </h4>
                    </div>
                    <div class="row" v-else-if="showProducts && productsLoaded">
                        <div class="item col-xl-4 col-md-6" v-for="(product, indx) in products" :key="indx">
                            <div is="product" :product="product"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Product from "./products/Product";

    export default {
        name: "ShopProducts",
        components: {Product},
        mounted() {
            this.fetchAll();
        },
        data() {
            return {
                products: [],
                categories: [],
                brands: [],
                loaded: false,
                productsLoaded: false,
                count: 12,
                page: 1,
                ordering: ''
            }
        },
        computed: {
            showProductsArea() {
                return this.categories.length > 0 && this.brands.length > 0;
            },
            showProducts() {
                return this.products.length > 0;
            }
        },
        props: {
            newProductUrl: {
                type: String,
                required: false
            },
            shopsDirectoryUrl: {
                type: String,
                required: false
            },
            admin: {
                type: Boolean,
                required: false,
                default: false
            },
            shop: {
                type: Object,
                required: true
            }
        },
        methods: {
            fetchAll() {
                let requests = [this.filterRequest(), this.productsRequest()];
                axios.all(requests).then(axios.spread(this.spreadResponse));
            },
            filterRequest() {
                return axios.post(graphql.api, {
                    query: graphql.shopCategoriesAndBrands,
                    variables: {id: this.shop.id, count: 50, page: 1}
                });
            },
            productsRequest() {
                return axios.post(graphql.api, {
                    query: graphql.shopProducts,
                    variables: {shopId: this.shop.id, count: this.count, page: this.page}
                });
            },
            spreadResponse(filters, products) {
                this.loadFilters(filters);
                this.loadProducts(products);
            },
            loadFilters(response) {
                this.loaded = true;
                this.categories = response.data.data.shop.categories.data;
                this.brands = response.data.data.shop.brands.data;
            },
            fetchProducts() {
                this.productsRequest().then(this.loadProducts).catch(function (error) {})
            },
            loadProducts(response) {
                this.productsLoaded = true;
                this.products = response.data.data.shop.products.data;
            }
        }
    }
</script>

<style scoped>

</style>