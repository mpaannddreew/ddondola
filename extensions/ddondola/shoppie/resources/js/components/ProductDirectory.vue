<template>
    <div class="directory">
        <categories :directory="directory"></categories>
        <product-directory-area></product-directory-area>
    </div>
</template>

<script>
    import Categories from "./Categories";
    import ProductDirectoryArea from "./ProductDirectoryArea";
    export default {
        name: "ProductDirectory",
        components: {ProductDirectoryArea, Categories},
        computed: {
            directory() {
                return 'products';
            }
        }
    }
</script>

<style scoped>

</style>