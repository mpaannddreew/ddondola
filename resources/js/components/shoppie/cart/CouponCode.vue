<template>
    <div class="card card-small border">
        <div class="card-header">
            <h6 class="text-uppercase">Coupon Code</h6>
        </div>
        <div class="card-body border-top">
            <p>If you have a coupon code, please enter it in the box below</p>
            <form action="#">
                <div class="form-group d-flex">
                    <input type="text" name="coupon">
                    <button type="submit" class="cart-black-button">Apply coupon</button>
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