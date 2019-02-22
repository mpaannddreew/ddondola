<template>
    <div class="row">
        <div class="col-md-3">
            <product-filter></product-filter>
        </div>
        <div class="col-md-9">
            <!--<div class="card card-small mb-3 background-0">-->
                <!--<div class="row no-gutters">-->
                    <!--<div class="col-lg-3 my-2 my-lg-0">-->
                        <!--<div class="input-group input-group-seamless">-->
                            <!--<div class="input-group-prepend">-->
                                <!--<div class="input-group-text">-->
                                    <!--<i class="material-icons">search</i>-->
                                <!--</div>-->
                            <!--</div>-->
                            <!--<input type="text" class="form-control form-control-sm" placeholder="Filter products">-->
                        <!--</div>-->
                    <!--</div>-->
                    <!--<div class="col text-right view-report">-->
                        <!--<p class="m-0 pr-2">Showing 10 of 120</p>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
            <div class="products-grid p-0">
                <div class="row">
                    <div class="item col-xl-4 col-md-6" v-for="(indx, product) in products">
                        <div is="shop-product"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ShopProduct from "./products/ShopProduct";
    import ProductFilter from "./filters/ProductFilter";

    export default {
        name: "ShopProducts",
        components: {ProductFilter, ShopProduct},
        data() {
            return {
                products: [1, 2, 3, 4, 5, 6, 7, 8]
            }
        }
    }
</script>

<style scoped>

</style>