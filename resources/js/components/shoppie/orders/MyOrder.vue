<template>
    <a href="javascript:void(0)" @click="transitionTo" class="list-group-item list-group-item-action d-flex">
        <div class="sc-stats__image">
            <img class="border rounded" :src="thumbnail">
        </div>
        <div class="ml-2 my-auto">
            <span class="text-uppercase text-ellipsis" style="display: block;">
                {{ order.code }}
            </span>
            <small class="text-muted" style="font-weight: bold;"><i class="material-icons">access_time</i> {{ order.created_at|day }}</small>
        </div>
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
                return `/me/orders/${this.order.code}`;
            },
            indicator() {
                return {
                    'text-success': this.order.paidFor,
                    'text-warning': !this.order.paidFor
                };
            }
        },
        methods: {
            transitionTo() {
                this.$router.push(this.route);
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