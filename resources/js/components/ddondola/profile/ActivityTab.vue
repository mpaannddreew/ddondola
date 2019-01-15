<template>
    <div class="product-feed-tab current" id="feed-dd">
        <feed-product></feed-product>
    </div>
</template>

<script>
    import FeedProduct from '../../shoppie/products/FeedProduct';
    export default {
        name: "FeedTab",
        components: {FeedProduct}
    }
</script>

<style scoped>

</style>