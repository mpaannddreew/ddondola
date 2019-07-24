<template>
    <div class="directory">
        <categories :directory="directory"></categories>
        <shop-directory-area></shop-directory-area>
    </div>
</template>

<script>
    import Categories from "./Categories";
    import ShopDirectoryArea from "./ShopDirectoryArea";
    export default {
        name: "ShopDirectory",
        components: {ShopDirectoryArea, Categories},
        computed: {
            directory() {
                return 'shops';
            }
        }
    }
</script>

<style scoped>

</style>