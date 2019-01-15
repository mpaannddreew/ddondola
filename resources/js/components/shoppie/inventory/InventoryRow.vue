<template>
    <tr>
        <td class="lo-stats__image">
            <img class="border rounded" src="/images/orders/product-order-1.jpg">
        </td>
        <td class="lo-stats__order-details">
            <span>#19280</span>
            <span>21 February 2018 20:32</span>
        </td>
        <td class="lo-stats__status">
            <div class="d-table mx-auto">
                <span class="badge badge-pill badge-success">In stock</span>
            </div>
        </td>
        <td class="lo-stats__items text-center">12</td>
        <td class="lo-stats__actions">
            <div class="btn-group d-table ml-auto" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-sm btn-white"><i class="fa fa-wrench"></i> Manage</button>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        name: "InventoryRow"
    }
</script>

<style scoped>

</style>