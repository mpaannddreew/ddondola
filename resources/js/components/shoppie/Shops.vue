<template>
    <div>
        <div class="card card-small border" v-if="!loaded">
            <div class="card-body">
                <div align="center">
                    <div class="loader"></div>
                    <p class="m-0">Loading shops...</p>
                </div>
            </div>
        </div>
        <div v-else-if="loaded">
            <header class="d-flex justify-content-between align-items-start mb-2">
                <visible-items :paginator-info="paginatorInfo" v-if="showShops && paginatorInfo"></visible-items>
                <span class="visible-items" v-else-if="!showShops"></span>
                <div class="btn-group">
                    <select class="form-control form-control-sm custom-select custom-select-sm" tabindex="-98" v-model="categoryId">
                        <option value="0">All</option>
                        <option v-for="(category, indx) in categories" :value="category.id" :key="indx">{{ category.name }}</option>
                    </select>
                </div>
            </header>
            <div class="card card-small border" v-if="!shopsLoaded || (!showShops && shopsLoaded)">
                <div class="card-body">
                    <div align="center" v-if="!shopsLoaded">
                        <div class="loader"></div>
                        <p class="m-0">Loading shops...</p>
                    </div>
                    <div align="center" v-if="!showShops && shopsLoaded">
                        <h4 class="m-0"><i class="material-icons">error</i></h4>
                        <p class="mb-3">There are no shops in the directory yet!</p>
                        <template v-if="mine">
                            <a :href="createShopUrl" class="btn btn-success btn-pill"><i class="fa fa-plus"></i> Create Shop</a>
                        </template>
                    </div>
                </div>
            </div>
            <div class="friend-list mb-4 mt-2" v-else-if="showShops && shopsLoaded">
                <div class="row">
                    <template v-for="(shop, indx) in shops">
                        <div class="col-md-4 col-sm-4">
                            <div is="shop" :shop="shop" :mine="mine" :url="url" :key="indx"></div>
                        </div>
                    </template>
                </div>
            </div>
            <pagination v-if="paginatorInfo" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
        </div>
    </div>
</template>

<script>
    import Shop from './shops/Shop';
    export default {
        name: "Shops",
        components: {Shop},
        mounted(){
            this.loadAll();
        },
        data() {
            return {
                shops: [],
                categories: [],
                categoryId: "0",
                page: 1,
                loaded: false,
                shopsLoaded: false,
                paginatorInfo: null
            }
        },
        methods: {
            loadAll() {
                let requests = [this.categoryRequest(), this.shopsRequest()];
                axios.all(requests).then(axios.spread(this.spreadResponse));
            },
            fetchShops() {
                this.shopsLoaded = false;
                this.shops = [];
                this.shopsRequest().then(this.loadShops).catch(function (error) {});
            },
            shopsRequest() {
                return axios.post(graphql.api, {
                    query: this.shopQuery,
                    variables: {categoryId: parseInt(this.categoryId), count: graphql.columnCount, page: this.page}
                });
            },
            categoryRequest() {
                return axios.post(graphql.api, {
                    query: graphql.categories
                });
            },
            spreadResponse(categories, shops) {
                this.loadCategories(categories);
                this.loadShops(shops);
            },
            loadCategories(categories) {
                this.loaded = true;
                this.categories = categories.data.data.categories;
            },
            loadShops(shops) {
                this.shopsLoaded = true;
                this.shops = this.mine ? shops.data.data.me.shops.data: shops.data.data.shops.data;
                this.paginatorInfo = this.mine ? shops.data.data.me.shops.paginatorInfo: shops.data.data.shops.paginatorInfo;
            },
            loadPage(page) {
                this.page = page;
                this.fetchShops();
            }
        },
        props: {
            mine: {
                type: Boolean,
                required: false,
                default: false
            },
            createShopUrl: {
                type: String,
                required: false
            },
            url: {
                type: String,
                required: true
            }
        },
        computed: {
            shopQuery() {
                return this.mine ? graphql.myShops: graphql.shops;
            },
            showShops() {
                return this.shops.length > 0;
            }
        },
        watch: {
            categoryId(data) {
                this.fetchShops();
            }
        }
    }
</script>

<style scoped>

</style>