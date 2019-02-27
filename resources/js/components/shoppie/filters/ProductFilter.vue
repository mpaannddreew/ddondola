<template>
    <div class="sidebar">
        <div class="block">
            <h6 class="text-uppercase mb-3">Product Categories</h6>
            <ul class="list-unstyled">
                <li>
                    <a href="#" class="d-flex justify-content-between align-items-center"><span>Men's Collection</span><small>200</small></a>
                    <ul class="list-unstyled">
                        <li> <a href="#">T-shirts</a></li>
                        <li> <a href="#">Hoodies</a></li>
                        <li> <a href="#">Shorts</a></li>
                    </ul>
                </li>
                <li class="active">
                    <a href="#" class="d-flex justify-content-between align-items-center"><span>Women's Collection</span><small>120</small></a>
                    <ul class="list-unstyled">
                        <li> <a href="#">T-shirts</a></li>
                        <li> <a href="#">Dresses</a></li>
                        <li> <a href="#">Pants</a></li>
                        <li> <a href="#">Shorts</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="d-flex justify-content-between align-items-center"><span>Accessories</span><small>80</small></a>
                    <ul class="list-unstyled">
                        <li> <a href="#">Wallets</a></li>
                        <li> <a href="#">Backpacks</a></li>
                        <li> <a href="#">Belts</a></li>
                        <li> <a href="#">Necklaces</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductFilter"
    }
</script>

<style scoped>

</style>