<template>
    <div class="card product is-gray">
        <div class="image d-flex align-items-center justify-content-center">
            <img src="/images/products/hoodie-man-1.png" alt="product" class="img-fluid">
            <div class="hover-overlay d-flex align-items-center justify-content-center">
                <div class="CTA d-flex align-items-center justify-content-center">
                    <a href="#">
                        <i class="fa fa-cart-plus"></i>
                    </a>
                    <a href="#" class="visit-product active">
                        <i class="fa fa-search"></i> View
                    </a>
                    <a href="#">
                        <i class="fa fa-heart"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="p-4 title">
            <small class="text-muted">Men Wear</small>
            <a href="detail.html">
                <h3 class="h6 text-uppercase no-margin-bottom">Elegant Lake</h3>
            </a>
            <span class="price text-muted">$40.00</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShopProduct"
    }
</script>

<style scoped>
    .card {
        border-radius: 2px;
    }
</style>