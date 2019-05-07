<template>
    <div class="card card-small border">
        <div class="card-header border-bottom">
            <h5 class="m-0"><i class="material-icons">short_text</i> Related Products</h5>
        </div>
        <div class="card-body p-0">
            <template v-if="!loaded">
                <div align="center" class="m-4">
                    <div class="loader"></div>
                    <p class="m-0">Loading related products...</p>
                </div>
            </template>
            <template v-if="hasRelated && loaded">
                <div class="d-flex align-items-center flex-row latest" v-for="(product, indx) in products">
                    <div class="p-2 lo-stats__image">
                        <img class="border rounded" :src="product.images[0].url">
                    </div>
                    <div class="p-2 lo-stats__order-details" style="display: inline-block; width: 87%;">
                        <span><a :href="'/products/' + product.code">{{ product.name }}</a></span>
                        <span class="text-uppercase">
                            <ul class="price list-inline no-margin">
                                <li class="list-inline-item deals_item_price_a" :class="{ 'text-primary': product.discount }">{{ product.currencyCode }} {{ product.discountedPrice }}</li>
                                <li class="list-inline-item deals_item_price_a" style="text-decoration: line-through;" v-if="product.discount">{{ product.currencyCode }} {{ product.price }}</li>
                            </ul>
                        </span>
                    </div>
                </div>
            </template>
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