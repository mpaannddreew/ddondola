<template>
    <div>
        <div class="products-grid p-0">
            <header class="d-flex justify-content-between align-items-start mb-4">
                <span class="visible-items" v-if="showProducts && loaded">Showing <strong>1-15 </strong>of <strong>158 </strong>results</span>
                <span class="visible-items" v-else></span>
                <div class="btn-group">
                    <select class="form-control" tabindex="-98" v-model="ordering">
                        <option value="latest">Latest</option>
                        <option value="oldest">Oldest</option>
                        <option value="lowest-price">Low Price</option>
                        <option value="highest-price">High Price</option>
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
            <div class="row" v-else-if="showProducts && loaded">
                <div class="item col-xl-3 col-md-6" v-for="(product, indx) in products">
                    <div is="product" :product="product" :key="indx"></div>
                </div>
            </div>
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
                ordering: ''
            }
        },
        computed: {
            showProducts() {
                return this.products.length > 0;
            }
        },
        methods: {
            fetchProducts() {
                axios.post(graphql.api, {
                    query: graphql.products,
                    variables: {count: this.count, page: this.page}
                }).then(this.loadProducts).catch(function (error) {});
            },
            loadProducts(response) {
                this.loaded = true;
                this.products = response.data.data.products.data;
            }
        }
    }
</script>

<style scoped>

</style>