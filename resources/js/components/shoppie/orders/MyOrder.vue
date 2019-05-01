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
                <button type="button" class="btn btn-sm btn-white" @click="toggleDetails" v-html="toggleTypo"></button>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        name: "MyOrder",
        mounted(){
            this.listen();
        },
        data() {
            return {
                isActive: false
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
            toggleTypo() {
                if (this.isActive) {
                    return '<i class="fa fa-caret-up"></i> Hide';
                }

                return '<i class="fa fa-caret-down"></i> Details';
            }
        },
        methods: {
            humanize(date) {
                return Moment(date).format("dddd, MMMM Do YYYY, h:mm:ss a");
            },
            toggleDetails() {
                this.isActive = !this.isActive;
                if (this.isActive) {
                    Bus.$emit('active', this.order.id);
                }else {
                    Bus.$emit('active', null);
                }
            },
            listen() {
                Bus.$on('active', this.changeStatus);
            },
            changeStatus(id) {
                this.isActive = (id === this.order.id);
            }
        }
    }
</script>

<style scoped>

</style>