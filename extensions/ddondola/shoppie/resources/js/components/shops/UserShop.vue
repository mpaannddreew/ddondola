<template>
    <tr>
        <td class="lo-stats__image">
            <img class="border rounded" :src="shop.avatar.url">
        </td>
        <td class="lo-stats__order-details">
            <span>{{ shop.name }}</span>
            <span class="text-uppercase">
                <mini-rating-meter :reviewable="shop"></mini-rating-meter>
            </span>
        </td>
        <td class="lo-stats__status" v-if="!directory">
            <div class="d-table mx-auto">
                <span class="badge badge-pill badge-success">Active</span>
            </div>
        </td>
        <td class="lo-stats__items" v-if="!directory">{{ shop.category.name }}</td>
        <td class="lo-stats__items text-center" v-if="!directory">{{ shop.productCount }}</td>
        <td>
            <div class="btn-group d-table ml-auto" role="group">
                <a :href="shopUrl" class="btn btn-sm btn-white" title=""><i class="fa fa-link"></i> Open</a>
                <a :href="settingsUrl" class="btn btn-sm btn-white" v-if="!directory && !admin"><i class="material-icons">settings</i></a>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        name: "UserShop",
        data() {
            return {}
        },
        props: {
            shop: {
                type: Object,
                required: true
            },
            directory: {
                type: Boolean,
                default: false
            },
            admin: {
                type: Boolean,
                default: false
            }
        },
        computed: {
            shopUrl() {
                if (this.admin) {
                    return '/admin/shops/' + this.shop.code;
                }

                return '/shops/' + this.shop.code;
            },
            settingsUrl() {
                return '/shops/' + this.shop.code + '/settings';
            }
        }
    }
</script>

<style scoped>

</style>