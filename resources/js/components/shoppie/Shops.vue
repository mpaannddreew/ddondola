<template>
    <div>
        <template v-if="!loaded">
            <div align="center"><div class="loader"></div></div>
        </template>
        <div v-else-if="loaded">
            <header class="d-flex justify-content-between align-items-start mb-4">
                <span class="visible-items" v-if="shopsAvailable">Showing <strong>1-15 </strong>of <strong>158 </strong>results</span>
                <span class="visible-items" v-else-if="!shopsAvailable"></span>
                <div class="btn-group">
                    <select class="form-control form-control-md custom-select custom-select-mdl" tabindex="-98">
                        <option value="0"></option>
                        <option v-for="(category, indx) in categories" :value="category.id" :key="indx">{{ category.name }}</option>
                    </select>
                </div>
            </header>
            <div class="card card-small lo-stats h-100 border">
                <table class="table mb-0">
                    <thead class="py-2 bg-light text-semibold border-bottom">
                    <tr>
                        <th>Details</th>
                        <th></th>
                        <th class="text-center">Products</th>
                        <th class="text-center">Likes</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-if="!shopsLoaded">
                        <tr>
                            <td colspan="5">
                                <div align="center"><div class="loader"></div></div>
                            </td>
                        </tr>
                    </template>
                    <template v-else-if="shopsLoaded && !shopsAvailable">
                        <tr>
                            <td colspan="5">
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
                            </td>
                        </tr>
                    </template>
                    <template v-else-if="shopsLoaded && shopsAvailable">
                        <tr v-for="(shop, indx) in shops" is="shop" :shop="shop" :mine="mine" :key="indx"></tr>
                    </template>
                    </tbody>
                </table>
            </div>
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
                page: 1,
                count: 10,
                loaded: false,
                shopsLoaded: false
            }
        },
        methods: {
            loadAll() {
                let requests = [this.categoryRequest(), this.shopsRequest()];
                axios.all(requests).then(axios.spread(this.spreadResponse));
            },
            fetchShops() {
                this.shopsRequest().then(this.loadShops).catch(function (error) {});
            },
            shopsRequest() {
                return axios.post(graphql.api, {
                    query: this.shopQuery,
                    variables: {count: this.count, page: this.page}
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
            }
        },
        computed: {
            shopQuery() {
                return this.mine ? graphql.myShops: graphql.shops;
            },
            shopsAvailable() {
                return this.shops.length > 0;
            }
        }
    }
</script>

<style scoped>

</style>