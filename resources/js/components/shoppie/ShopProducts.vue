<template>
    <div>
        <div class="card card-small border" v-if="!loaded || (!showProductsArea && loaded || !brandsHaveProducts && !categoriesHaveProducts)">
            <div class="card-body">
                <div align="center" v-if="!loaded">
                    <div class="loader"></div>
                    <p class="m-0">Loading shop...</p>
                </div>
                <div align="center" v-else-if="!showProductsArea && loaded || !brandsHaveProducts && !categoriesHaveProducts">
                    <h4 class="m-0"><i class="material-icons">error</i></h4>
                    <template v-if="!admin">
                        <p class="mb-3">This shop has no products listed yet!</p>
                        <a :href="shopsDirectoryUrl" class="btn btn-success btn-pill"><i class="material-icons">folder_open</i> Discover new shops</a>
                    </template>
                    <template v-if="admin">
                        <p class="mb-3">You have not added any products yet!</p>
                        <a :href="newProductUrl" class="btn btn-success btn-pill"><i class="fa fa-plus"></i> Add Products</a>
                    </template>
                </div>
            </div>
        </div>
        <div class="row" v-else-if="showProductsArea && loaded">
            <div class="col-md-3 px-2">
                <rating-meter :reviewable="shop"></rating-meter>
                <about-shop class="my-2" :shop="shop"></about-shop>
                <div class="sidebar">
                    <div class="card card-small border mb-2">
                        <div class="card-header border-bottom">
                            <h6 class="m-0"><i class="material-icons">short_text</i> Product Categories</h6>
                        </div>
                        <div class="card-body">
                            <div class="block p-0 m-0">
                                <ul class="list-unstyled mr-0">
                                    <template v-for="(category, indx) in categories" >
                                        <li :key="indx" :id="'category-' + category.id" :class="{active: categoryId === category.id}" v-if="category.productCount">
                                            <a href="javascript:void(0);" class="d-flex justify-content-between align-items-center" @click="showCategory(category.id)">
                                                <span><i class="material-icons">label</i> {{ category.name }}</span><small>{{ category.productCount }}</small>
                                            </a>
                                            <ul class="list-unstyled">
                                                <template v-for="(subcategory, indx_) in category.categories.data">
                                                    <li :key="indx_" :id="'subcategory-' + subcategory.id" :class="{active: subcategoryId === subcategory.id}" v-if="subcategory.productCount">
                                                        <a href="javascript:void(0);" @click="showSubcategory(subcategory.id, category.id)"><i class="material-icons">label_outline</i> {{ subcategory.name }}</a>
                                                    </li>
                                                </template>
                                            </ul>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card card-small border">
                        <div class="card-header border-bottom">
                            <h6 class="m-0"><i class="material-icons">short_text</i> Brands</h6>
                        </div>
                        <div class="card-body">
                            <div class="block p-0 m-0">
                                <template v-for="(brand, indx) in brands">
                                    <div class="custom-control custom-checkbox" :class="{ 'mb-3': indx !== (brands.length - 1) }" :key="indx" v-if="brand.productCount">
                                        <input :id="'brand_' + indx" type="checkbox" name="clothes-brand" class="custom-control-input" v-model="brandIds" :value="brand.id">
                                        <label class="custom-control-label d-flex" style="display: block;" :for="'brand_' + indx">{{ brand.name }} <small class="ml-auto">({{ brand.productCount }})</small></label>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="products-grid p-0" id="products">
                    <header class="d-flex justify-content-between align-items-start mb-2">
                        <visible-items :paginator-info="paginatorInfo" v-if="showProducts && productsLoaded && paginatorInfo"></visible-items>
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
                    <div class="card card-small border" v-if="!productsLoaded || (!showProducts && productsLoaded)">
                        <div class="card-body">
                            <div align="center" v-if="!productsLoaded">
                                <div class="loader"></div>
                                <p class="m-0">Loading products...</p>
                            </div>
                            <div align="center" v-else-if="!showProducts && productsLoaded">
                                <h4 class="m-0"><i class="material-icons">remove_shopping_cart</i></h4>
                                <template v-if="!admin">
                                    <p class="mb-3">This shop has no products listed yet!</p>
                                    <a :href="shopsDirectoryUrl" class="btn btn-success btn-pill"><i class="material-icons">folder_open</i> Discover new shops</a>
                                </template>
                                <template v-if="admin">
                                    <p class="mb-3">You have not added any products yet!</p>
                                    <a :href="newProductUrl" class="btn btn-success btn-pill"><i class="fa fa-plus"></i> Add Products</a>
                                </template>
                            </div>
                        </div>
                    </div>
                    <template v-else-if="showProducts && productsLoaded">
                        <div class="row">
                            <div class="item col-xl-4 col-md-6 px-2" v-for="(product, indx) in products" :key="indx">
                                <div is="product" :product="product" :url="url"></div>
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
                page: 1,
                ordering: '',
                paginatorInfo: null
            }
        },
        computed: {
            showProductsArea() {
                return this.showCategories && this.showBrands;
            },
            showBrands() {
                return this.brands.length > 0;
            },
            showCategories() {
                return this.categories.length > 0;
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
                var variables = {filters: this.filters, count: graphql.columnCount, page: this.page};

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
            },
            brandsHaveProducts() {
                return Collect(this.brands).reject(function(value, key) {
                    return value.productCount === 0;
                }).count() > 0;
            },
            categoriesHaveProducts() {
                return Collect(this.categories).reject(function(value, key) {
                    return value.productCount === 0;
                }).count() > 0;
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
            },
            url: {
                type: String,
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
                console.log(JSON.stringify(response.data));
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
                this.categoryId = "";
                this.subcategoryId = "";
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