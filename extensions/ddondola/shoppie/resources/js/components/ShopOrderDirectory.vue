<template>
    <div class="directory orders">
        <shop-orders></shop-orders>
        <router-view></router-view>
    </div>
</template>

<script>
    import ShopOrders from "./ShopOrders";
    export default {
        name: "ShopOrderDirectory",
        components: {ShopOrders}
    }
</script>

<style scoped>

</style>