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
                                        <li><a href="shop.html" class="mb-2 btn btn-lg btn-pill btn-outline-primary mr-2"><i class="fa fa-chevron-left"></i> Continue Shopping</a></li>
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
    export default {
        name: "Cart",
        components: {CartEntry},
        data() {
            return {
                entries: [1, 2]
            }
        },
        props: {
            checkoutUrl: {
                type: String,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>