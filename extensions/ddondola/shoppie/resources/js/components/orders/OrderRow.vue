<template>
    <tr class="cart-item">
        <template v-if="updating">
            <td colspan="6" class="product-total">
                <div align="center">
                    <div class="loader"></div>
                    <p class="m-0">Updating order item...</p>
                </div>
            </td>
        </template>
        <template v-else>
            <td class="row-img lo-stats__image" :class="classDef">
                <img class="border rounded" :src="product.images[0].url" alt="product-img">
            </td>
            <td class="product-name" :class="classDef"><a :href="productUrl">{{ product.name }}</a></td>
            <td class="product-price" :class="classDef">{{ product.currencyCode }} {{ product.pivot.price|commas }}</td>
            <td class="product-quantity" :class="classDef">{{ product.pivot.quantity }}</td>
            <td class="product-subtotal">{{ product.currencyCode }} {{ product.pivot.sum|commas }}</td>
            <td class="row-close close-2">
                <div class="btn-group btn-group-sm ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" role="group">
                    <template v-if="showActions">
                        <a href="javascript:void(0)" class="btn btn-white text-success" @click="confirm" :class="{disabled: !orderPaidFor || otherProcessing}">
                            <i class="material-icons">check</i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-white text-danger" @click="cancel" :class="{disabled: otherProcessing}">
                            <i class="material-icons">clear</i>
                        </a>
                    </template>
                    <template v-else>
                        <a href="javascript:void(0)" class="btn btn-white disabled" :class="actionColor">
                            {{ action }}
                        </a>
                    </template>
                </div>
            </td>
        </template>
    </tr>
</template>

<script>
    export default {
        name: "OrderRow",
        mounted() {
            this.listen();
        },
        data() {
            return {
                updating: false,
                otherProcessing: false
            }
        },
        props: {
            product: {
                type: Object,
                required: true
            },
            order: {
                type: String,
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
                if(this.product.pivot.cancelled)
                    return false;

                if (this.shop && !this.product.pivot.delivery_confirmed)
                    return true;

                return !this.shop && !this.product.pivot.receipt_confirmed;
            },
            actor() {
                return this.shop ? 'SELLER' : 'BUYER';
            },
            action() {
                if(this.product.pivot.cancelled)
                    return 'Cancelled';

                if (this.shop && this.product.pivot.delivery_confirmed)
                    return 'Delivered';

                if (!this.shop && this.product.pivot.receipt_confirmed)
                    return 'Received';

                return null;
            },
            actionColor() {
                return {
                    'text-danger': this.product.pivot.cancelled,
                    'text-success': this.shop && this.product.pivot.delivery_confirmed || !this.shop && this.product.pivot.receipt_confirmed
                }
            }
        },
        methods: {
            confirm() {
                if (this.orderPaidFor) {
                    this.dialog(`Confirm item ${this.shop ? 'delivery':'receipt'}`).then((result) => {
                        if (result.value) {
                            this.update('CONFIRM');
                        }
                    });
                }
            },
            cancel() {
                this.dialog("Cancel item").then((result) => {
                    if (result.value) {
                        this.update('CANCEL');
                    }
                });
            },
            dialog(title) {
                return Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#17c671',
                    cancelButtonColor: '#d33',
                    confirmButtonText: title,
                    cancelButtonText: "Close"
                });
            },
            update(action) {
                this.updating = true;
                Bus.$emit('updating', this.product.id);
                axios.post(graphql.api, {
                    query: graphql.updateOrder,
                    variables: {update: {order: this.order, product: this.product.code, action: action, actor: this.actor}}
                }).then(this.updated).catch(function (error) {});
            },
            updated(response) {
                this.updating = false;
                Bus.$emit('updated', this.product.id);
                this.$emit('updated');
            },
            listen() {
                Bus.$on('updating', this.isUpdating);
                Bus.$on('updated', this.isUpdated);
            },
            isUpdating(id) {
                if (this.product.id !== id) {
                    this.otherProcessing = true;
                }
            },
            isUpdated(id) {
                if (this.product.id !== id) {
                    this.otherProcessing = false;
                }
            }
        }
    }
</script>

<style scoped>

</style>