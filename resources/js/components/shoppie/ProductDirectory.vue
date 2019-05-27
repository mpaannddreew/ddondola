<template>
    <div class="directory">
        <categories :directory="directory"></categories>
        <router-view></router-view>
    </div>
</template>

<script>
    import Categories from "./Categories";
    export default {
        name: "ProductDirectory",
        components: {Categories},
        computed: {
            directory() {
                return 'products';
            }
        }
    }
</script>

<style scoped>

</style>