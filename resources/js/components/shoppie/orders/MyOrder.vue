<template>
    <tr>
        <td class="lo-stats__image">
            <img class="border rounded" :src="thumbnail">
        </td>
        <td class="lo-stats__order-details">
            <span class="text-uppercase">{{ order.code }}</span>
            <span>{{ humanize(order.created_at) }}</span>
        </td>
        <td class="lo-stats__items text-center">{{ order.productCount }}</td>
        <td class="lo-stats__total text-center text-success">{{ order.currencyCode }} {{ order.sum }}</td>
        <td class="lo-stats__actions">
            <div class="btn-group d-table ml-auto" role="group">
                <a href="javascript:void(0)" class="btn btn-sm btn-white" @click="transitionTo"><i class="fa fa-link"></i> View Order</a>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        name: "MyOrder",
        mounted(){},
        data() {
            return {

            }
        },
        props: {
            order: {
                type: Object,
                required: true
            }
        },
        computed: {
            firstProduct() {
                return this.order.firstProduct;
            },
            thumbnail() {
                return this.firstProduct.images[0].url;
            },
            route() {
                return '/me/orders/' + this.order.code;
            }
        },
        methods: {
            humanize(date) {
                return Moment(date).format("dddd, MMMM Do YYYY, h:mm:ss a");
            },
            transitionTo() {
                this.$router.push(this.route);
            }
        }
    }
</script>

<style scoped>

</style>