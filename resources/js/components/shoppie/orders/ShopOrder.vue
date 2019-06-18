<template>
    <li class="is-active" data-order="46895" @click="transitionTo">
        <div>
            <span class="text-uppercase text-accent mb-1" style="display: block">Order-{{ order.code }}</span>
            <span class="text-muted" style="display: block">
            <i class="material-icons">account_circle</i> {{ order.by.name }} [{{ order.created_at|time }}]
        </span>
        </div>
        <span class="order-indicator is-progress"></span>
    </li>
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
            thumbnail() {
                return this.order.by.avatar.url;
            },
            shopUrl() {
                return '/shops/' + this.$route.params.shop;
            },
            route() {
                return this.shopUrl + '/orders/' + this.order.code;
            },
            messengerUrl() {
                return this.shopUrl + '/messenger/' + this.order.by.code;
            }
        },
        methods: {
            transitionTo() {
                this.$router.push(this.route);
            }
        },
        filters: {
            time(date) {
                if (Moment().isSame(Moment(date), 'd'))
                    return Moment(date).format("h:mm a");

                if (Moment().subtract(1, 'days').isSame(Moment(date), 'd'))
                    return 'Yesterday';

                return Moment(date).format("MM/DD/YY");
            }
        }
    }
</script>

<style scoped>

</style>