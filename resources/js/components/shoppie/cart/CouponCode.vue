<template>
    <div class="card card-small border">
        <div class="card-header">
            <h6 class="text-uppercase">Coupon Code</h6>
        </div>
        <div class="card-body border-top">
            <p>If you have a coupon code, please enter it in the box below</p>
            <form action="#">
                <div class="form-group d-flex">
                    <input type="text" name="coupon" class="p-2 border-radius border-top-right-radius-0 border-bottom-right-radius-0">
                    <button type="submit" class="cart-black-button border-radius border-bottom-left-radius-0 border-top-left-radius-0">Apply coupon</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CouponCode"
    }
</script>

<style scoped>

</style>