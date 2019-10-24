<template>
    <div class="directory-area">
        <div class="card card-small main">
            <div class="card-header p-0 border-bottom bg-light">
                <header class="d-flex justify-content-between align-items-start" style="margin: .6rem !important;">
                    <visible-items :paginator-info="paginatorInfo" v-if="showShops && paginatorInfo"></visible-items>
                    <span class="visible-items" v-else-if="!showShops"></span>
                    <div class="d-flex">
                        <select class="form-control form-control-sm custom-select custom-select-sm mr-2" tabindex="-98" v-model="ordering">
                            <option value=""></option>
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                        <a :href="newShopUrl" class="btn btn-sm btn-success ml-auto" v-if="auth && seller">
                            <i class="material-icons">add</i> New Shop
                        </a>
                    </div>
                </header>
            </div>
            <div class="card-body h-100">
                <div class="center-xy" v-if="!loaded || (!showShops && loaded)">
                    <div align="center" v-if="!loaded">
                        <div class="loader"></div>
                        <p class="m-0">Loading shops...</p>
                    </div>
                    <div align="center" v-if="!showShops && loaded">
                        <h4 class="m-0"><i class="material-icons">error</i></h4>
                        <p class="m-0">There are no shops in the directory yet!!</p>
                    </div>
                </div>
                <div class="card card-small lo-stats border-top-radius-0" style="border-top: 0 !important;" v-else-if="showShops && loaded">
                    <table class="table mb-0">
                        <thead class="py-2 bg-light text-semibold">
                        <tr>
                            <th class="border-top-0">Details</th>
                            <th class="border-top-0"></th>
                            <th class="text-right border-top-0"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr is="user-shop" v-for="(shop, indx) in shops" :key="indx" :shop="shop" :directory="true"></tr>
                        </tbody>
                    </table>
                </div>
                <pagination v-if="paginatorInfo" class="my-2" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
            </div>
        </div>
    </div>
</template>

<script>
    import UserShop from "./shops/UserShop";
    export default {
        name: "ShopDirectoryArea",
        components: {UserShop},
        mounted() {
            this.fetchShops();
            this.listen();
        },
        data() {
            return {
                shops: [],
                page: 1,
                loaded: false,
                paginatorInfo: null,
                ordering: '',
                categoryIds: [],
                searchFilter: ''
            }
        },
        methods: {
            fetchShops() {
                this.loaded = false;
                this.shops = [];
                this.shopsRequest().then(this.loadShops).catch(function (error) {});
            },
            shopsRequest() {
                return axios.post(graphql.api, {
                    query: graphql.shops,
                    variables: this.variables
                });
            },
            loadShops(shops) {
                this.loaded = true;
                this.shops = shops.data.data.shops.data;
                this.paginatorInfo = shops.data.data.shops.paginatorInfo;
            },
            loadPage(page) {
                this.page = page;
                this.fetchShops();
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
        computed: {
            showShops() {
                return this.shops.length > 0;
            },
            newShopUrl() {
                return '/me/shops/create';
            },
            filters() {
                return  {categoryIds: JSON.stringify(this.categoryIds), name: this.searchFilter, ordering: this.ordering}
            },
            variables() {
                return {filters: this.filters, count: graphql.rowCount, page: this.page};
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