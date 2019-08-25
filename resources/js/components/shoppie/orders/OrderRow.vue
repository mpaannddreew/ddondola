<template>
    <tr class="cart-item">
        <td class="row-img lo-stats__image" :class="classDef">
            <img class="border rounded" :src="product.images[0].url" alt="product-img">
        </td>
        <td class="product-name" :class="classDef"><a :href="productUrl">{{ product.name }}</a></td>
        <td class="product-price" :class="classDef">{{ product.currencyCode }} {{ product.pivot.price|commas }}</td>
        <td class="product-quantity" :class="classDef">{{ product.pivot.quantity }}</td>
        <td class="product-subtotal" :class="classDef">{{ product.currencyCode }} {{ product.pivot.sum|commas }}</td>
        <td class="row-close close-2">
            <div class="btn-group btn-group-sm ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" role="group">
                <a href="javascript:void(0)" class="btn btn-white text-success">
                    <i class="material-icons">check</i>
                </a>
                <a href="javascript:void(0)" class="btn btn-white text-danger" v-if="!orderPaidFor">
                    <i class="material-icons">clear</i>
                </a>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        name: "OrderRow",
        props: {
            product: {
                type: Object,
                required: true
            },
            shop: {
                type: String
            },
            orderPaidFor: {
                type: Boolean,
                default: false
            }
        },
        computed: {
            productUrl() {
                return `/products/${this.product.code}`;
            },
            classDef() {
                return {'border-bottom-0': this.shop};
            }
        }
    }
</script>

<style scoped>

</style>