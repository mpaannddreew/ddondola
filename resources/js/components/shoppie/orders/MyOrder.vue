<template>
    <li class="is-active" data-order="46895" @click="transitionTo">
        <div>
            <span class="text-uppercase text-accent" style="display: block">Order {{ order.code }}</span>
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