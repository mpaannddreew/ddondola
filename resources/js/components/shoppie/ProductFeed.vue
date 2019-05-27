<template>
    <div>
        <div class="card card-small border">
            <div class="card-header border-bottom">
                <h5 class="m-0"><i class="material-icons">local_mall</i> Product Recommendations</h5>
            </div>
            <div class="card-body p-0">
                <div align="center" class="p-4" v-if="!loaded">
                    <div class="loader"></div>
                    <p class="m-0">Loading recommendations...</p>
                </div>
                <div align="center" class="p-4" v-if="!showProducts && loaded">
                    <h4 class="m-0"><i class="material-icons">error</i></h4>
                    <p class="m-0">No recommendations available</p>
                </div>
                <template v-if="showProducts && loaded">
                    <feed-product v-for="(product, indx) in products" :product="product" :key="indx"></feed-product>
                </template>
            </div>
        </div>
        <template v-if="loadingMore">
            <div align="center" class="p-4"><div class="loader"></div></div>
        </template>
        <a href="javascript:void(0)" v-if="!loadingMore && loaded" @click="loadMore" class="btn-view btn-load-more border" :class="{disabled: loaderDisabled}"></a>
    </div>
</template>

<script>
    import FeedProduct from "./products/FeedProduct";
    export default {
        name: "ProductFeed",
        components: {FeedProduct},
        mounted() {
            this.initialCount();
            this.fetchProducts();
        },
        data() {
            return {
                products: [],
                loaded: false,
                loadingMore: false,
                page: 1,
                count: 0,
                paginatorInfo: null
            }
        },
        computed: {
            showProducts() {
                return this.products.length > 0;
            },
            loaderDisabled() {
                if (this.paginatorInfo) {
                    return !this.paginatorInfo.hasMorePages;
                }

                return true;
            }
        },
        methods: {
            fetchProducts() {
                axios.post(graphql.api, {
                    query: graphql.myProductFeed,
                    variables: {count: this.count, page: this.page}
                }).then(this.loadProducts).catch(function (error) {});
            },
            loadProducts(response) {
                this.loaded = true;
                this.products = response.data.data.me.products.data;
                this.paginatorInfo = response.data.data.me.products.paginatorInfo;
            },
            initialCount() {
                this.count = graphql.rowCount;
            },
            loadMore() {
                this.loadingMore = true;
                this.count += graphql.rowCount;
                this.fetchProducts();
            }
        }
    }
</script>

<style scoped>

</style>