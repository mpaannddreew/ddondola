<template>
    <div class="directory">
        <directory-filters :directory="directory"></directory-filters>
        <product-directory-area></product-directory-area>
    </div>
</template>

<script>
    import ProductDirectoryArea from "./ProductDirectoryArea";
    import DirectoryFilters from "./DirectoryFilters";
    export default {
        name: "ProductDirectory",
        components: {DirectoryFilters, ProductDirectoryArea},
        computed: {
            directory() {
                return 'products';
            }
        }
    }
</script>

<style scoped>

</style>