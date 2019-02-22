<template>
    <div class="row">
        <div class="col-md-3">
            <shop-filter></shop-filter>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6" v-for="(indx, shop) in shops">
                    <div is="shop"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Shop from "./shops/Shop";
    // import Shop from "./shops/ShopL";
    import ShopFilter from "./filters/ShopFilter";
    export default {
        name: "Shops",
        components: {ShopFilter, Shop},
        data() {
            return {
                shops: [1, 2, 3, 4]
            }
        },
        methods: {

        }
    }
</script>

<style scoped>

</style>