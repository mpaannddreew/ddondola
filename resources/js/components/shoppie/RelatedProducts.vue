<template>
    <div>
        <div align="center" v-if="!loaded"><div class="loader"></div></div>
        <div align="center" v-if="!hasRelated && loaded">
            <h4>
                <i class="material-icons">error_outline</i>
                <br />
                <small>No related products found!</small>
                <br />
            </h4>
        </div>
        <div v-if="hasRelated && loaded">
            <div class="products-grid p-0">
                <div class="row">
                    <div class="item col-xl-3 col-md-6" v-for="(product, indx) in products">
                        <div is="product" :key="indx" :product="product" :url="url"></div>
                    </div>
                </div>
            </div>
        </div>
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
            url: {
                type: String,
                required: true
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