<template>
    <div class="card card-small border">
        <div class="card-header">
            <h6 class="text-uppercase">Order Summary</h6>
        </div>
        <div class="card-body border-top">
            <p>Shipping and additional costs are calculated based on values you have entered.</p>
            <ul class="order-menu list-unstyled">
                <li class="d-flex justify-content-between"><span>Order Subtotal </span><strong>$390.00</strong></li>
                <li class="d-flex justify-content-between"><span>Shipping and handling</span><strong>$10.00</strong></li>
                <li class="d-flex justify-content-between"><span>Tax</span><strong>$0.00</strong></li>
                <li class="d-flex justify-content-between"><span>Total</span><strong class="text-primary price-total">$400.00</strong></li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "OrderSummary"
    }
</script>

<style scoped>

</style>