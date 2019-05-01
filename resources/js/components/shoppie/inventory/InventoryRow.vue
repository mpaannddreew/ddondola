<template>
    <tr>
        <td class="lo-stats__image">
            <img class="border rounded" :src="product.images[0].url">
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
        <td class="lo-stats__items text-center">{{ product.currencyCode }} {{ product.discountedPrice }}</td>
        <td>
            <div class="btn-group d-table ml-auto" role="group">
                <a :href="productUrl" class="btn btn-sm btn-white" title=""><i class="fa fa-file"></i></a>
                <a :href="editUrl" class="btn btn-sm btn-white" title=""><i class="material-icons">mode_edit</i></a>
                <a :href="stockUrl" class="btn btn-sm btn-white"><i class="material-icons">local_mall</i></a>
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
        },
        computed: {
            productUrl() {
                return this.url + '/products/' + this.product.code
            },
            stockUrl() {
                return this.productUrl + "/stock"
            },
            editUrl() {
                return this.productUrl + "/edit"
            }
        }
    }
</script>

<style scoped>

</style>