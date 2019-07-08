<template>
    <tr>
        <td class="lo-stats__image">
            <img class="border rounded" :src="product.images[0].url">
        </td>
        <td class="lo-stats__order-details">
            <span>{{ product.name }}</span>
            <span class="text-uppercase">
                <mini-rating-meter :reviewable="product"></mini-rating-meter>
            </span>
        </td>
        <td class="lo-stats__status">
            <div class="d-table mx-auto">
                <span class="badge badge-pill" :class="{'badge-success': hasStock, 'badge-danger': !hasStock}">{{ availability }}</span>
            </div>
        </td>
        <td class="lo-stats__items text-center">{{ product.quantity }}</td>
        <td class="lo-stats__items text-center" v-if="!admin">{{ product.brand.name }}</td>
        <td class="lo-stats__items text-center" v-if="!admin">{{ product.category.name }}</td>
        <td class="lo-stats__items text-center" v-if="!admin">{{ product.subcategory.name }}</td>
        <td class="lo-stats__items text-center">{{ product.currencyCode }} {{ product.discountedPrice }}</td>
        <td>
            <div class="btn-group d-table ml-auto" role="group">
                <a :href="productUrl" class="btn btn-sm btn-white" title="">
                    <i class="fa fa-link"></i> Details
                </a>
                <template v-if="!admin">
                    <a :href="editUrl" class="btn btn-sm btn-white" title=""><i class="material-icons">mode_edit</i></a>
                    <a :href="stockUrl" class="btn btn-sm btn-white"><i class="material-icons">local_mall</i></a>
                </template>
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
            admin: {
                type: Boolean,
                default: false
            }
        },
        computed: {
            productUrl() {
                return '/products/' + this.product.code
            },
            stockUrl() {
                return this.productUrl + "/stock"
            },
            editUrl() {
                return this.productUrl + "/edit"
            },
            hasStock() {
                return this.product.quantity > 0;
            },
            availability() {
                if (this.hasStock) {
                    return 'In stock';
                }

                return 'Out of stock';
            }
        }
    }
</script>

<style scoped>

</style>