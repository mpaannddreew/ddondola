<template>
    <div class="row">
        <div class="col-md-3">
            <shop-filter></shop-filter>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6" v-for="(indx, shop) in shops">
                    <div class="strip grid" is="grid-shop"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import GridShop from "./shops/GridShop";
    import ShopFilter from "./ShopFilter";
    export default {
        name: "UserShops",
        components: {ShopFilter, GridShop},
        data() {
            return {
                shops: [1, 2, 3, 4]
            }
        }
    }
</script>

<style scoped>

</style>