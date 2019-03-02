<template>
    <div class="sidebar">
        <div class="block border-bottom">
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
        <div class="block">
            <h6 class="text-uppercase">Brands </h6>
            <form action="#">
                <div class="custom-control custom-checkbox mb-3">
                    <input id="brand0" type="checkbox" name="clothes-brand" checked="" class="custom-control-input">
                    <label class="custom-control-label" for="brand0">Calvin Klein <small>(18)</small></label>
                </div>
                <div class="custom-control custom-checkbox mb-3">
                    <input id="brand1" type="checkbox" name="clothes-brand" checked="" class="custom-control-input">
                    <label class="custom-control-label" for="brand1">Levi Strauss <small>(30)</small></label>
                </div>
                <div class="custom-control custom-checkbox mb-3">
                    <input id="brand2" type="checkbox" name="clothes-brand" class="custom-control-input">
                    <label class="custom-control-label" for="brand2">Hugo Boss <small>(120)</small></label>
                </div>
                <div class="custom-control custom-checkbox mb-3">
                    <input id="brand3" type="checkbox" name="clothes-brand" class="custom-control-input">
                    <label class="custom-control-label" for="brand3">Tomi Hilfiger <small>(70)</small></label>
                </div>
                <div class="custom-control custom-checkbox mb-3">
                    <input id="brand4" type="checkbox" name="clothes-brand" class="custom-control-input">
                    <label class="custom-control-label" for="brand4">Tom Ford  <small>(110)</small></label>
                </div>
            </form>
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