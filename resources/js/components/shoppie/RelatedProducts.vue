<template>
    <div>
        <div class="section-heading my-4">
            <h2>Related Products</h2>
        </div>
        <div class="products-grid p-0">
            <div class="row">
                <div class="item col-xl-3 col-md-6" v-for="(indx, product) in products">
                    <div is="product"></div>
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
        data() {
            return {
                products: [1, 2, 3, 4]
            }
        }
    }
</script>

<style scoped>

</style>