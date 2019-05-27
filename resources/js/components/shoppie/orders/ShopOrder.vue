<template>
    <tr>
        <td class="lo-stats__image">
            <img class="border rounded" :src="thumbnail">
        </td>
        <td class="lo-stats__order-details">
            <span class="text-uppercase">{{ order.by.name }}</span>
            <span>{{ humanize(order.created_at) }}</span>
        </td>
        <td class="lo-stats__items text-center">{{ order.by.email }}</td>
        <td class="lo-stats__actions">
            <div class="btn-group d-table ml-auto" role="group">
                <a :href="messengerUrl" class="btn btn-sm btn-white"><i class="material-icons">chat</i> Message</a>
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
            },
            shop: {
                type: String,
                required: true
            }
        },
        computed: {
            thumbnail() {
                return this.order.by.avatar.url;
            },
            shopUrl() {
                return '/shops/' + this.shop;
            },
            route() {
                return this.shopUrl + '/orders/' + this.order.code;
            },
            messengerUrl() {
                return this.shopUrl + '/messenger/' + this.order.by.code;
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