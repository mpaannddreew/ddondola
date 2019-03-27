<template>
    <div>
        <template v-if="!loaded">
            <div align="center"><div class="loader"></div></div>
        </template>
        <div v-else-if="loaded">
            <header class="d-flex justify-content-between align-items-start">
                <visible-items :paginator-info="paginatorInfo" v-if="showShops && paginatorInfo"></visible-items>
                <span class="visible-items" v-else-if="!showShops"></span>
                <div class="btn-group">
                    <select class="form-control form-control-sm custom-select custom-select-sm" tabindex="-98" v-model="categoryId">
                        <option value="0">All</option>
                        <option v-for="(category, indx) in categories" :value="category.id" :key="indx">{{ category.name }}</option>
                    </select>
                </div>
            </header>
            <template v-if="!shopsLoaded">
                <div align="center"><div class="loader"></div></div>
            </template>
            <template v-else-if="!showShops && shopsLoaded">
                <div align="center">
                    <h4>
                        <i class="material-icons">error_outline</i>
                        <br />
                        <template v-if="mine">
                            <small>You have not created any shops yet!</small>
                            <br />
                            <a :href="createShopUrl" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Create Shop</a>
                        </template>
                        <small v-else-if="!mine">There are no shops in the directory yet!</small>
                    </h4>
                </div>
            </template>
            <div class="row" id="grid-items" v-else-if="showShops && shopsLoaded">
                <template v-for="(shop, indx) in shops">
                    <div class="col-xs-12 col-sm-3 col-md-12 col-lg-3">
                        <div is="shop" :shop="shop" :mine="mine" :url="url" :key="indx"></div>
                    </div>
                </template>
            </div>
            <pagination v-if="paginatorInfo" class="my-4" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
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
                count: 12,
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
                    variables: {categoryId: parseInt(this.categoryId), count: this.count, page: this.page}
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