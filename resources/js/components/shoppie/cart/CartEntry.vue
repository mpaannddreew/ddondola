<template>
    <tr class="cart-item">
        <td class="row-close close-1" data-title="product-remove"><a href="#"><i class="ion-close-circled"></i></a></td>
        <td class="row-img"><img src="/images/cart/cart-inner-img-1.jpg" alt="cart-img"></td>
        <td class="product-name" data-title="Product"><a :href="productUrl">{{ product.name }}</a></td>
        <td class="product-price" data-title="Price"><p>{{ product.currencyCode }} {{ product.pivot.price }}</p></td>
        <td class="product-quantity" data-title="Quantity">
            <div class="quantity_filter">
                <button type="button" class="minus btn btn-sm btn-pill btn-outline-primary border-bottom-right-radius-0 border-top-right-radius-0" @click="minus">-</button>
                <input class="quantity-number qty" type="text" v-model="quantity">
                <button type="button" class="plus btn btn-sm btn-pill btn-outline-primary border-bottom-left-radius-0 border-top-left-radius-0" @click="plus">+</button>
            </div>
        </td>
        <td class="product-total" data-title="Subprice"><p>{{ product.currencyCode }} {{ subtotal }}</p></td>
        <td class="row-close close-2" data-title="product-remove">
            <div align="center" v-if="deleting"><div class="loader"></div></div>
            <a href="javascript:void(0)" v-else @click="removeFromCart"><i class="ion-close-circled"></i></a>
        </td>
    </tr>
</template>

<script>
    export default {
        name: "CartEntry",
        mounted() {
            this.quantity = this.product.pivot.quantity;
            this.stock = this.product.quantity;
        },
        data() {
            return {
                quantity: '',
                stock: '',
                deleting: false
            }
        },
        props: {
            product: {
                type: Object,
                required: true
            }
        },
        computed: {
            subtotal() {
                return this.quantity * this.product.pivot.price;
            },
            productUrl() {
                return '/products/' + this.product.code;
            }
        },
        methods: {
            minus() {
                this.quantity --;
            },
            plus() {
                this.quantity ++;
            },
            removeFromCart() {
                this.deleting = true;
                axios.post(graphql.api, {
                    query: graphql.removeFromCart,
                    variables: {id: this.product.id}
                }).then(this.cartStatus).catch(function (error) {});
            },
            cartStatus(response) {
                this.deleting = false;
                if (!response.data.data.inCart) {
                    this.$emit('product', this.product.id);
                    Bus.$emit('cart-size', {type: 'decrease', count: 1});
                    DToast("success", "Product removed from cart");
                }
            }
        },
        watch: {
            quantity(data) {
                if (data < 1) {
                    this.quantity = 1;
                }else if (data > this.stock) {
                    this.quantity = this.stock;
                }
            }
        }
    }
</script>

<style scoped>

</style>
