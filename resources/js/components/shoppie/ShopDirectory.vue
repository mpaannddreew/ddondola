<template>
    <div class="directory">
        <categories :directory="directory"></categories>
        <router-view></router-view>
    </div>
</template>

<script>
    import Categories from "./Categories";
    export default {
        name: "ShopDirectory",
        components: {Categories},
        computed: {
            directory() {
                return 'shops';
            }
        }
    }
</script>

<style scoped>

</style>