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
                            <template v-for="(category, indx) in categories" >
                                <li :key="indx" v-if="category.productCount" :id="'category-' + category.id" :class="{active: categoryId === category.id}">
                                    <a href="javascript:void(0);" class="d-flex justify-content-between align-items-center" @click="showCategory(category.id)">
                                        <span>{{ category.name }}</span><small>{{ category.productCount }}</small>
                                    </a>
                                    <ul class="list-unstyled">
                                        <template v-for="(subcategory, indx_) in category.categories.data">
                                            <li :key="indx_" v-if="subcategory.productCount" :id="'subcategory-' + subcategory.id" :class="{active: subcategoryId === subcategory.id}">
                                                <a href="javascript:void(0);" @click="showSubcategory(subcategory.id, category.id)">{{ subcategory.name }}</a>
                                            </li>
                                        </template>
                                    </ul>
                                </li>
                            </template>
                        </ul>
                    </div>
                    <div class="block">
                        <h6 class="text-uppercase">Brands</h6>
                        <template v-for="(brand, indx) in brands">
                            <div class="custom-control custom-checkbox mb-3" :key="indx" v-if="brand.productCount">
                                <input :id="'brand_' + indx" type="checkbox" name="clothes-brand" class="custom-control-input" v-model="brandIds" :value="brand.id">
                                <label class="custom-control-label" :for="'brand_' + indx">{{ brand.name }} <small>({{ brand.productCount }})</small></label>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="products-grid p-0" id="products">
                    <header class="d-flex justify-content-between align-items-start">
                        <visible-items :paginator-info="paginatorInfo" v-if="showProducts && productsLoaded && paginatorInfo"></visible-items>
                        <span class="visible-items" v-else></span>
                        <div class="btn-group">
                            <select class="form-control" tabindex="-98" v-model="ordering">
                                <option value="latest">Latest</option>
                                <option value="oldest">Oldest</option>
                                <option value="lowest-price">Lowest Price</option>
                                <option value="highest-price">Highest Price</option>
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
                    <template v-else-if="showProducts && productsLoaded">
                        <div class="row">
                            <div class="item col-xl-4 col-md-6" v-for="(product, indx) in products" :key="indx">
                                <div is="product" :product="product"></div>
                            </div>
                        </div>
                    </template>
                    <pagination v-if="paginatorInfo" class="my-4" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
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
        data: function () {
            return {
                products: [],
                categories: [],
                brands: [],
                brandIds: [],
                categoryId: '',
                subcategoryId: '',
                loaded: false,
                productsLoaded: false,
                count: 12,
                page: 1,
                ordering: '',
                paginatorInfo: null
            }
        },
        computed: {
            showProductsArea() {
                return this.categories.length > 0 && this.brands.length > 0;
            },
            showProducts() {
                return this.products.length > 0;
            },
            filters() {
                return {
                    ordering: this.ordering,
                    brandIds: JSON.stringify(this.brandIds)
                }
            },
            productVariables() {
                var variables = {filters: this.filters, count: this.count, page: this.page};

                if (this.subcategoryId) {
                    variables["subcategoryId"] = this.subcategoryId;
                }else if(this.categoryId) {
                    variables["categoryId"] = this.categoryId;
                }else {
                    variables["shopId"] = this.shop.id;
                }

                return variables;
            },
            productQuery() {
                if (this.subcategoryId) {
                    return graphql.subcategoryProducts
                }else if(this.categoryId) {
                    return graphql.categoryProducts
                }else {
                    return graphql.shopProducts;
                }
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
                    query: this.productQuery,
                    variables: this.productVariables
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
                this.productsLoaded = false;
                this.products = [];
                this.productsRequest().then(this.loadProducts).catch(function (error) {})
            },
            loadProducts(response) {
                this.productsLoaded = true;
                if (this.subcategoryId) {
                    this.products = response.data.data.subcategory.products.data;
                    this.paginatorInfo = response.data.data.subcategory.products.paginatorInfo;
                }else if(this.categoryId) {
                    this.products = response.data.data.category.products.data;
                    this.paginatorInfo = response.data.data.category.products.paginatorInfo;
                }else {
                    this.products = response.data.data.shop.products.data;
                    this.paginatorInfo = response.data.data.shop.products.paginatorInfo;
                }
            },
            showCategory(categoryId) {
                this.categoryId = categoryId;
                this.subcategoryId = "";
                this.loadPage(1);
            },
            showSubcategory(subcategoryId, categoryId) {
                this.categoryId = categoryId;
                this.subcategoryId = subcategoryId;
                this.loadPage(1);
            },
            loadPage(page) {
                this.page = page;
                this.fetchProducts();
            }
        },
        watch: {
            brandIds(data) {
                this.loadPage(1);
            },
            ordering(data) {
                this.loadPage(1);
            }
        }
    }
</script>

<style scoped>

</style>