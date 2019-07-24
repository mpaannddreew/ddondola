<template>
    <div>
        <template v-if="!loaded">
            <div align="center" class="my-2">
                <div class="loader"></div>
                <p class="m-0">Loading products from same seller...</p>
            </div>
        </template>
        <template v-if="hasRelated && loaded">
            <div class="products-grid p-0" id="products">
                <div class="row">
                    <div class="item col-xl-6 col-md-6" v-for="(product, indx) in products" :key="indx">
                        <div is="product" :product="product" :auth="auth"></div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
    import Product from "./products/Product";
    export default {
        name: "RelatedProducts",
        components: {Product},
        mounted() {
            this.getRelated();
        },
        data() {
            return {
                products: [],
                loaded: false
            }
        },
        props: {
            product: {
                type: Object,
                required: true
            },
            auth: {
                type: Boolean,
                required: false,
                default: true
            }
        },
        computed: {
            hasRelated() {
                return this.products.length > 0;
            }
        },
        methods: {
            getRelated() {
                axios.post(graphql.api, {
                    query: graphql.relatedProducts,
                    variables: {id: this.product.id}
                }).then(this.loadRelated).catch(function (error) {});
            },
            loadRelated(response) {
                this.loaded = true;
                this.products = response.data.data.product.products;
            }
        }
    }
</script>

<style scoped>

</style>