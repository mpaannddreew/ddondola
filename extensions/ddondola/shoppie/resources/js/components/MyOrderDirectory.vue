<template>
    <div class="directory orders">
        <my-orders></my-orders>
        <router-view></router-view>
    </div>
</template>

<script>
    import MyOrders from "./MyOrders";
    export default {
        name: "MyOrderDirectory",
        components: {MyOrders}
    }
</script>

<style scoped>

</style>