<template>
    <tr class="cart-item">
        <td class="row-close close-1" data-title="product-remove"><a href="#"><i class="ion-close-circled"></i></a></td>
        <td class="row-img"><img src="/images/cart/cart-inner-img-1.jpg" alt="cart-img"></td>
        <td class="product-name" data-title="Product"><a href="#">Variable product 001</a></td>
        <td class="product-price" data-title="Price"><p>$ 78.00</p></td>
        <td class="product-quantity" data-title="Quantity">
            <div class="quantity_filter">
                <input type="button" value="-" class="minus" @click="minus">
                <input class="quantity-number qty" type="text" v-model="quantity" min="1" max="10">
                <input type="button" value="+" class="plus" @click="plus">
            </div>
        </td>
        <td class="product-total" data-title="Subprice"><p>$ 156.00</p></td>
        <td class="row-close close-2" data-title="product-remove"><a href="#"><i class="ion-close-circled"></i></a></td>
    </tr>
</template>

<script>
    export default {
        name: "CartEntry",
        data() {
            return {
                quantity: 1,
                inStock: 10
            }
        },
        methods: {
            minus() {
                this.quantity --;
            },
            plus() {
                this.quantity ++;
            }
        },
        watch: {
            quantity: {
                handler(quantity) {
                    if (quantity < 1) {
                        this.quantity = 1;
                    }else if (quantity > this.inStock) {
                        this.quantity = this.inStock;
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>
