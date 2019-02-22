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
                            <tr v-for="(indx, entry) in entries" is="cart-entry"></tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="12">
                                    <ul class="table-btn">
                                        <li><a href="shop.html" class="btn btn-continue"><i class="fa fa-chevron-left"></i>Continue Shopping</a></li>
                                    </ul>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <section class="cart-box-section py-4">
            <div class="row justify-content-between">
                <div class="col-lg-4 col-md-6">
                    <div class="box-1 text-center card border">
                        <div class="ci-title border-bottom">
                            <h6>Promotional code</h6>
                        </div>
                        <div class="ci-caption">
                            <p class="mb-3">Enter Your Coupon Code If you have one</p>
                            <form>
                                <input required="" class="form-control mb-4" type="text" placeholder="Coupon Code">
                                <button class="btn btn-continue" type="submit">Apply Coupon Code</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="box-2 text-center card border">
                        <div class="ci-title border-bottom">
                            <h6>Cart Total</h6>
                        </div>
                        <div class="ci-caption">
                            <ul class="pl-0">
                                <li>Subtotal <span>$237.00</span></li>
                                <li>Total <span>$237.00</span></li>

                            </ul>
                        </div>
                        <div class="ci-btn border-top">
                            <a href="checkout.html" class="btn btn-checkout btn-block rounded-0">Proceed to Checkout</a>
                        </div>
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
        }
    }
</script>

<style scoped>

</style>