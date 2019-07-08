<template>
    <div class="directory-list border-right">
        <div class="card card-small main">
            <div class="card-header border-bottom bg-light">
                <div class="input-group input-group-seamless" style="min-width: unset !important; width: unset !important;">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <input class="form-control bg-light" type="text" placeholder="Filter Shops" aria-label="Search">
                </div>
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
                <ul class="contact-list" v-else-if="showShops && loaded">
                    <li is="shop" v-for="(shop, indx) in shops" :key="indx" :shop="shop"></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import Shop from "../admin/Shop";
    export default {
        name: "Shops",
        components: {Shop},
        mounted() {
            this.fetchShops();
        },
        props: {
            category: {
                type: String,
                required: false
            }
        },
        data() {
            return {
                shops: [],
                page: 1,
                loaded: false,
                paginatorInfo: null,
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
            }
        },
        computed: {
            showShops() {
                return this.shops.length > 0;
            },
            variables() {
                return {count: graphql.rowCount, page: this.page};
            }
        }
    }
</script>

<style scoped>

</style>