<template>
    <tr class="cart-item">
        <template v-if="saving">
            <td colspan="6" class="product-total">
                <div align="center">
                    <div class="loader"></div>
                    <p class="m-0">Updating product in cart...</p>
                </div>
            </td>
        </template>
        <template v-else>
            <td class="row-close close-1" data-title="product-remove"><a href="#"><i class="ion-close-circled"></i></a></td>
            <td class="row-img lo-stats__image">
                <img class="border rounded" :src="product.images[0].url" alt="cart-img">
            </td>
            <td class="product-name" data-title="Product"><a :href="productUrl">{{ product.name }}</a></td>
            <td class="product-price" data-title="Price"><p>{{ product.currencyCode }} {{ product.pivot.price|commas }}</p></td>
            <td class="product-quantity" data-title="Quantity" v-if="editing">
                <div class="quantity_filter">
                    <button type="button" class="minus btn btn-sm btn-pill btn-outline-primary border-bottom-right-radius-0 border-top-right-radius-0" @click="minus">-</button>
                    <input class="quantity-number qty" type="text" v-model="quantity">
                    <button type="button" class="plus btn btn-sm btn-pill btn-outline-primary border-bottom-left-radius-0 border-top-left-radius-0" @click="plus">+</button>
                </div>
            </td>
            <td class="product-quantity" v-else>{{ product.pivot.quantity }}</td>
            <td class="product-total" data-title="Subprice"><p>{{ product.currencyCode }} {{ subtotal|commas }}</p></td>
            <td class="row-close close-2" data-title="product-remove">
                <template v-if="deleting">
                    <div align="center"><div class="loader"></div></div>
                </template>
                <template v-else>
                    <div class="btn-group btn-group-sm ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" role="group" :class="{disabled: otherProcessing}">
                        <template v-if="editing">
                            <a href="javascript:void(0)" @click="updateInCart" class="btn btn-white text-success">
                                <i class="material-icons">save</i>
                            </a>
                            <a href="javascript:void(0)" @click="cancelUpdate" class="btn btn-white">
                                <i class="material-icons">clear</i>
                            </a>
                        </template>
                        <template v-else>
                            <a href="javascript:void(0)" @click="confirm" class="btn btn-white">
                                <i class="material-icons">delete</i>
                            </a>
                            <a href="javascript:void(0)" @click="editCart" class="btn btn-white text-info">
                                <i class="material-icons">edit</i>
                            </a>
                        </template>
                    </div>
                </template>
            </td>
        </template>
    </tr>
</template>

<script>
    export default {
        name: "CartEntry",
        mounted() {
            this.quantity = this.product.pivot.quantity;
            this.stock = this.product.quantity;
            this.listen();
        },
        data() {
            return {
                quantity: 1,
                stock: null,
                deleting: false,
                editing: false,
                saving: false,
                otherProcessing: false
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
                Bus.$emit('deleting', this.product.id);
                axios.post(graphql.api, {
                    query: graphql.removeFromCart,
                    variables: {id: this.product.id}
                }).then(this.cartStatus).catch(function (error) {});
            },
            cartStatus(response) {
                this.deleting = false;
                if (!response.data.data.inCart) {
                    this.$emit('cart-updated');
                    this.$emit('deleted', this.product.id);
                    Bus.$emit('deleted', this.product.id);
                    Bus.$emit('cart-size', {type: 'decrease', count: 1});
                    DToast("success", "Product removed from cart");
                }
            },
            editCart() {
                this.quantity = this.product.pivot.quantity;
                this.editing = true;
                Bus.$emit('editing', this.product.id);
            },
            cancelUpdate() {
                this.quantity = this.product.pivot.quantity;
                this.editing = false;
            },
            updateInCart() {
                Bus.$emit('saving', this.product.id);
                this.saving = true;
                axios.post(graphql.api, {
                    query: graphql.addToCart,
                    variables: {id: this.product.id, quantity: this.quantity}
                }).then(this.cartUpdated).catch(function (error) {});
            },
            cartUpdated(response) {
                this.saving = false;
                this.cancelUpdate();
                Bus.$emit('saved');
                if (response.data.data.inCart) {
                    this.$emit('cart-updated');
                }else {
                    DToast("error", "Product could not be updated in cart");
                }
            },
            listen() {
                Bus.$on('editing', this.isEditing);
                Bus.$on('saving', this.isProcessing);
                Bus.$on('deleting', this.isProcessing);
                Bus.$on('saved', this.isProcessed);
                Bus.$on('deleted', this.isProcessed);
            },
            isEditing(id) {
                if (this.product.id !== id) {
                    this.cancelUpdate();
                }
            },
            isProcessing(id) {
                if (this.product.id !== id) {
                    this.otherProcessing = true;
                }
            },
            isProcessed(id) {
                if (this.product.id !== id) {
                    this.otherProcessing = false;
                }
            },
            confirm() {
                this.dialog("Remove from cart").then((result) => {
                    if (result.value) {
                        this.removeFromCart();
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
            }
        },
        watch: {
            quantity(data) {
                this.quantity = _.replace(data, /[^\d]/,'');
                if (data < 1) {
                    this.quantity = 1;
                }else if (data === '') {
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
