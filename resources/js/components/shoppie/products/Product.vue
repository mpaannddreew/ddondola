<template>
    <div class="card product is-gray border">
        <div class="image d-flex align-items-center justify-content-center border-bottom">
            <div class="ribbon ribbon-info text-uppercase">Offer</div>
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
            <small class="text-muted">{{ product.subcategory.name }}</small>
            <a href="#">
                <h3 class="h6 text-uppercase no-margin-bottom">{{ product.name }}</h3>
            </a>
            <span class="price text-muted">UGX {{ product.price }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShopProduct",
        mounted() {
            console.log("product");
        },
        data() {
            return {}
        },
        props: {
            product: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>
</style>