<template>
    <tr class="cart-item">
        <td class="row-img lo-stats__image" :class="classDef">
            <img class="border rounded" :src="product.images[0].url" alt="product-img">
        </td>
        <td class="product-name" :class="classDef"><a :href="productUrl">{{ product.name }}</a></td>
        <td class="product-price" :class="classDef">{{ product.currencyCode }} {{ product.pivot.price|commas }}</td>
        <td class="product-quantity" :class="classDef">{{ product.pivot.quantity }}</td>
        <td class="product-subtotal">{{ product.currencyCode }} {{ product.pivot.sum|commas }}</td>
        <td class="row-close close-2">
            <div class="btn-group btn-group-sm ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" role="group" v-if="showActions">
                <a href="javascript:void(0)" class="btn btn-white text-success" @click="confirm">
                    <i class="material-icons">check</i>
                </a>
                <a href="javascript:void(0)" class="btn btn-white text-danger" @click="cancel">
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
            },
            showActions() {
                return this.shop ? !this.product.pivot.delivery_confirmed : !this.product.pivot.receipt_confirmed;
            },
            confirmed() {
                return {
                    'fa-minus-circle text-warning': this.product.pivot.delivery_confirmed || this.product.pivot.receipt_confirmed,
                    'fa-times-circle-o text-danger': !this.product.pivot.delivery_confirmed && !this.product.pivot.receipt_confirmed,
                    'fa-check-circle-o text-success': this.product.pivot.delivery_confirmed && this.product.pivot.receipt_confirmed
                }
            }
        },
        methods: {
            confirm() {
                this.dialog(`Confirm item ${this.shop ? 'delivery':'receipt'}`).then((result) => {
                    if (result.value) {

                    }
                })
            },
            cancel() {
                this.dialog("Cancel item").then((result) => {
                    if (result.value) {

                    }
                })
            },
            dialog(title) {
                return Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to undo this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#17c671',
                    cancelButtonColor: '#d33',
                    confirmButtonText: title,
                    cancelButtonText: "Close"
                });
            }
        }
    }
</script>

<style scoped>

</style>