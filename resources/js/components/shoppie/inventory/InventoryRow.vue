<template>
    <tr>
        <td class="lo-stats__image">
            <img class="border rounded" src="/images/orders/product-order-1.jpg">
        </td>
        <td class="lo-stats__order-details">
            <span>{{ product.name }}</span>
            <span class="text-uppercase">{{ product.code }}</span>
        </td>
        <td class="lo-stats__status">
            <div class="d-table mx-auto">
                <span class="badge badge-pill badge-success">In stock</span>
            </div>
        </td>
        <td class="lo-stats__items text-center">{{ product.quantity }}</td>
        <td class="lo-stats__items text-center">{{ product.category.name }}</td>
        <td class="lo-stats__items text-center">{{ product.subcategory.name }}</td>
        <td class="lo-stats__items text-center">{{ product.brand.name }}</td>
        <td class="lo-stats__actions">
            <div class="btn-group d-table ml-auto" role="group" aria-label="Basic example">
                <a :href="url + '/products/' + product.code" class="btn btn-sm btn-white"><i class="fa fa-wrench"></i> Manage</a>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        name: "InventoryRow",
        data() {
            return {}
        },
        props: {
            product: {
                type: Object,
                required: true
            },
            url: {
                type: String,
                required: true
            }
        }
    }
</script>

<style scoped>
    span.code {
        ;
    }
</style>