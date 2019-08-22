<template>
    <a href="javascript:void(0)" @click="transitionTo" class="list-group-item list-group-item-action warning">
        <div class="d-flex">
            <span class="text-uppercase" style="display: block">{{ order.code }}</span>
            <span class="ml-auto">({{ order.productCount }})</span>
        </div>
        <small class="text-muted"><i class="material-icons">date_range</i> {{ order.created_at|time }}</small>
    </a>
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
                let time = Moment(date).format("h:mm a");
                if (Moment().isSame(Moment(date), 'd'))
                    return `Today at ${time}`;

                if (Moment().subtract(1, 'days').isSame(Moment(date), 'd'))
                    return `Yesterday at ${time}`;

                return `${Moment(date).format("dddd, MMMM Do YYYY")} at ${time}`;
            },
            daysFromNow(date) {
                return Moment(date).fromNow();
            }
        }
    }
</script>

<style scoped>
    a.list-group-item.list-group-item-action:hover small {
        color: #6c757d!important;
    }

    a.list-group-item.list-group-item-action.warning {
        border-left: medium solid #ffc107!important
    }

    a.list-group-item.list-group-item-action.danger {
        border-left: medium solid #dc3545!important
    }

    a.list-group-item.list-group-item-action.success {
        border-left: medium solid #28a745!important
    }
</style>