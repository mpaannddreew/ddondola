<template>
    <tr>
        <td class="lo-stats__image">
            <img class="border rounded" src="/images/orders/product-order-1.jpg">
        </td>
        <td class="lo-stats__order-details">
            <span>{{ shop.name }}</span>
            <span class="text-uppercase">{{ shop.category.name }}</span>
        </td>
        <td class="lo-stats__items text-center">12</td>
        <td class="lo-stats__total text-center text-success">90</td>
        <td class="lo-stats__actions">
            <div class="btn-group d-table ml-auto" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-sm btn-white">Go to</button>
                <button type="button" class="btn btn-sm btn-white" v-show="mine">Edit</button>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        name: "Shop",
        data() {
            return {}
        },
        props: {
            mine: {
                type: Boolean,
                required: true
            },
            shop: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>