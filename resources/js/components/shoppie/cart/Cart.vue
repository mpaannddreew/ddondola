<template>
    <div>
        <section class="cart-section card border">
            <div class="row">
                <div class="col-md-12">
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr class="row-1" style="border-bottom: 0;">
                                <th class="row-title"><p>Item</p></th>
                                <th class="row-title"><p>Product Name</p></th>
                                <th class="row-title"><p>Price</p></th>
                                <th class="row-title"><p>Quantity</p></th>
                                <th class="row-title"><p>Subtotal</p></th>
                                <th class="row-title"><p></p></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(indx, entry) in entries" is="cart-entry" :key="indx"></tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="12">
                                    <ul class="table-btn m-0 p-0">
                                        <li>
                                            <a :href="shoppingUrl" class="mb-2 btn btn-lg btn-pill btn-outline-primary mr-2">
                                                <i class="fa fa-chevron-left"></i> Continue Shopping
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <section class="order-details py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 pl-0">
                        <coupon-code></coupon-code>
                        <div class="card card-small border my-4">
                            <div class="card-header">
                                <h6 class="text-uppercase">Instructions for seller</h6>
                            </div>
                            <div class="card-body border-top">
                                <p>If you have some information for the seller you can leave them in the box below</p>
                                <form action="#">
                                    <textarea name="instructions"></textarea>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 pr-0 mb-4">
                        <order-summary></order-summary>
                    </div>
                    <div class="col-lg-12 text-center">
                        <a :href="checkoutUrl" class="btn btn-lg btn-pill btn-outline-primary" style="text-transform: uppercase;">
                            Proceed to checkout <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import CartEntry from "./CartEntry";
    import CouponCode from "./CouponCode";
    import OrderSummary from "./OrderSummary";
    export default {
        name: "Cart",
        components: {OrderSummary, CouponCode, CartEntry},
        data() {
            return {
                entries: [1, 2]
            }
        },
        props: {
            checkoutUrl: {
                type: String,
                required: true
            },
            shoppingUrl: {
                type: String,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>