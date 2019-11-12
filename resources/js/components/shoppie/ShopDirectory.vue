<template>
    <div class="directory">
        <directory-filters :directory="directory"></directory-filters>
        <shop-directory-area></shop-directory-area>
    </div>
</template>

<script>
    import ShopDirectoryArea from "./ShopDirectoryArea";
    import DirectoryFilters from "./DirectoryFilters";
    export default {
        name: "ShopDirectory",
        components: {DirectoryFilters, ShopDirectoryArea},
        computed: {
            directory() {
                return 'shops';
            }
        }
    }
</script>

<style scoped>

</style>