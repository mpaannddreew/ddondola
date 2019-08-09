<template>
    <div class="directory">
        <shop-product-filters :shop="shop" :admin="admin"></shop-product-filters>
        <shop-product-area :shop="shop.code" :admin="admin"></shop-product-area>
    </div>
</template>

<script>
    import ShopProductArea from "./ShopProductArea";
    import ShopProductFilters from "./ShopProductFilters";
    export default {
        name: "ShopProducts",
        components: {ShopProductFilters, ShopProductArea},
        data() {
            return {}
        },
        props: {
            admin: {
                type: Boolean,
                default: false
            },
            shop: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>
    .directory {
        height: calc(99.9vh - 7.05rem - 1px);
    }
</style>