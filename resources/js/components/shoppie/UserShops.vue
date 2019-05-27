<template>
    <div>
        <div class="mb-2">
            <div class="row no-gutters">
                <div class="col-lg-6 mb-2 mb-lg-0">
                    <form action="POST">
                        <div class="input-group input-group-seamless">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="material-icons"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control form-control-sm" placeholder="Filter shops">
                        </div>
                    </form>
                </div>
                <div class="col">
                    <div class="d-flex ml-lg-auto my-auto">
                        <div class="btn-group btn-group-sm ml-lg-auto" role="group" aria-label="Table row actions">
                            <div class="btn-group">
                                <select class="form-control form-control-sm custom-select custom-select-sm" tabindex="-98" v-model="ordering">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-small lo-stats h-100 mb-4 border border-top-radius-0">
            <table class="table mb-0">
                <thead class="py-2 bg-light text-semibold border-bottom">
                <tr>
                    <th>Details</th>
                    <th></th>
                    <th class="text-center">Status</th>
                    <th>Category</th>
                    <th class="text-center">products</th>
                    <th class="text-right"></th>
                </tr>
                </thead>
                <tbody>
                <template v-if="!loaded || (!showShops && loaded)">
                    <tr>
                        <td colspan="9">
                            <div align="center" v-if="!loaded">
                                <div class="loader"></div>
                                <p class="m-0">Loading shops...</p>
                            </div>
                            <div align="center" v-if="!showShops && loaded">
                                <h4 class="m-0"><i class="material-icons">error</i></h4>
                                <p class="m-0">You have not created any shops yet!</p>
                            </div>
                        </td>
                    </tr>
                </template>
                <template v-else-if="showShops && loaded">
                    <tr is="user-shop" v-for="(shop, indx) in shops" :key="indx" :shop="shop"></tr>
                </template>
                </tbody>
            </table>
        </div>
        <pagination v-if="paginatorInfo" class="my-2" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
    </div>
</template>

<script>
    import UserShop from "./shops/UserShop";
    export default {
        name: "UserShops",
        components: {UserShop},
        mounted() {
            this.fetchShops();
        },
        data() {
            return {
                shops: [],
                loaded: false,
                page: 1,
                ordering: '',
                paginatorInfo: null
            }
        },
        computed: {
            showShops() {
                return this.shops.length > 0;
            }
        },
        methods: {
            fetchShops() {
                this.loaded = false;
                this.shops = [];
                axios.post(graphql.api, {
                    query: graphql.myShops,
                    variables: {count: graphql.rowCount, page: this.page}
                }).then(this.loadShops).catch(function (error) {});
            },
            loadShops(shops) {
                this.loaded = true;
                this.shops = shops.data.data.me.shops.data;
                this.paginatorInfo = shops.data.data.me.shops.paginatorInfo;
            },
            loadPage(page) {
                this.page = page;
                this.fetchShops();
            }
        }
    }
</script>

<style scoped>

</style>