<template>
    <div>
        <div class="products-grid p-0">
            <header class="d-flex justify-content-between align-items-start mb-4">
                <visible-items :paginator-info="paginatorInfo" v-if="showProducts && loaded && paginatorInfo"></visible-items>
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
            <div align="center" v-if="!loaded"><div class="loader"></div></div>
            <div align="center" v-else-if="!showProducts && loaded">
                <h4>
                    <i class="material-icons">error_outline</i>
                    <br />
                    <small>There are no products in the directory yet!</small>
                </h4>
            </div>
            <template v-else-if="showProducts && loaded">
                <div class="row">
                    <div class="item col-xl-3 col-md-6" v-for="(product, indx) in products">
                        <div is="product" :product="product" :url="url" :key="indx"></div>
                    </div>
                </div>
            </template>
            <pagination v-if="paginatorInfo" class="my-4" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
        </div>
    </div>
</template>

<script>
    import Product from "./products/Product";
    export default {
        name: "Products",
        components: {Product},
        mounted() {
            this.fetchProducts();
        },
        data() {
            return {
                products: [],
                loaded: false,
                count: 12,
                page: 1,
                ordering: '',
                paginatorInfo: null
            }
        },
        props: {
            url: {
                type: String,
                required: true
            }
        },
        computed: {
            showProducts() {
                return this.products.length > 0;
            }
        },
        methods: {
            fetchProducts() {
                this.loaded = false;
                this.products = [];
                axios.post(graphql.api, {
                    query: graphql.products,
                    variables: {count: this.count, filters: {ordering: this.ordering}, page: this.page}
                }).then(this.loadProducts).catch(function (error) {});
            },
            loadProducts(response) {
                this.loaded = true;
                this.products = response.data.data.products.data;
                this.paginatorInfo = response.data.data.products.paginatorInfo;
            },
            loadPage(page) {
                this.page = page;
                this.fetchProducts();
            }
        },
        watch: {
            ordering(data) {
                this.loadPage(1);
            }
        }
    }
</script>

<style scoped>

</style>