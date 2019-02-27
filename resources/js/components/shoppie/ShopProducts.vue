<template>
    <div class="row">
        <div class="col-md-3">
            <product-filter></product-filter>
        </div>
        <div class="col-md-9">
            <div class="products-grid p-0">
                <header class="d-flex justify-content-between align-items-start">
                    <span class="visible-items">Showing <strong>1-15 </strong>of <strong>158 </strong>results</span>
                    <div class="btn-group">
                        <select class="form-control" tabindex="-98">
                            <option value="newest">Newest</option>
                            <option value="oldest">Oldest</option>
                            <option value="lowest-price">Low Price</option>
                            <option value="heigh-price">High Price</option>
                        </select>
                    </div>
                </header>
                <div class="row">
                    <div class="item col-xl-4 col-md-6" v-for="(indx, product) in products">
                        <div is="product"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Product from "./products/Product";
    import ProductFilter from "./filters/ProductFilter";

    export default {
        name: "ShopProducts",
        components: {ProductFilter, Product},
        data() {
            return {
                products: [1, 2, 3, 4, 5, 6, 7, 8, 9]
            }
        }
    }
</script>

<style scoped>

</style>