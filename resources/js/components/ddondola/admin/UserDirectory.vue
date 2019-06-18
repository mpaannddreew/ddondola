<template>
    <div class="directory admin">
        <users></users>
        <router-view></router-view>
    </div>
</template>

<script>
    import Users from "./Users";
    export default {
        name: "UserDirectory",
        components: {Users}
    }
</script>

<style scoped>

</style>