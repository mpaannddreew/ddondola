<template>
    <div>
        <div class="card card-small border">
            <div class="card-body p-0">
                <div align="center" class="p-4" v-if="!loaded">
                    <div class="loader"></div>
                    <p class="m-0">Loading products...</p>
                </div>
                <div align="center" class="p-4" v-if="!showProducts && loaded">
                    <h4 class="m-0"><i class="material-icons">error</i></h4>
                    <!--todo adopt message to showing tab-->
                    <p class="m-0">It looks like you have no activity. Follow some people or add shops to your favourites to get lists of their recent additions.</p>
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
        name: "ProductFeedTab",
        components: {FeedProduct},
        mounted() {
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
        props: {
            showing: {
                type: String,
                required: true
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
            },
            title() {
                return _.upperFirst(this.showing) + ' Products'
            }
        },
        methods: {
            resetFeed() {
                this.loaded = false;
                this.paginatorInfo = null;
                this.products = [];
                this.initialCount();
                this.page = 1;
            },
            fetchProducts() {
                this.resetFeed();
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
        },
        watch: {
            showing(data) {
                this.fetchProducts();
            }
        }
    }
</script>

<style scoped>

</style>