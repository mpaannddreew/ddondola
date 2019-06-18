<template>
    <div class="directory admin">
        <shops></shops>
        <router-view></router-view>
    </div>
</template>

<script>
    import Shops from "./Shops";
    export default {
        name: "ShopAdminDirectory",
        components: {Shops}
    }
</script>

<style scoped>

</style>