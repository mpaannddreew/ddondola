<template>
    <div>
        <div class="container py-2">
            <div class="mb-2">
                <div class="row no-gutters">
                    <div class="col-lg-6 mb-2 mb-lg-0">
                        <form action="POST">
                            <div class="input-daterange input-group input-group-md w-100">
                                <input type="text" class="input-sm form-control form-control-sm" name="start" placeholder="Start Date">
                                <input type="text" class="input-sm form-control form-control-sm" name="end" placeholder="End Date">
                                <span class="input-group-append">
                                    <span class="input-group-text">
                                          <i class="material-icons">date_range</i>
                                    </span>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <div class="d-flex ml-lg-auto my-auto">
                            <div class="btn-group btn-group-sm ml-lg-auto" role="group" aria-label="Table row actions">
                                <div class="btn-group">
                                    <select class="form-control form-control-sm custom-select custom-select-sm" tabindex="-98" v-model="showing">
                                        <option value="all">All</option>
                                        <option value="pending">Pending</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-small lo-stats h-100 border mt-2">
                <table class="table mb-0">
                    <thead class="py-2 bg-light text-semibold border-bottom">
                    <tr>
                        <th>Details</th>
                        <th></th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Items</th>
                        <th class="text-center">Total</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
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
                                <span class="badge badge-pill badge-success">Complete</span>
                            </div>
                        </td>
                        <td class="lo-stats__items text-center">12</td>
                        <td class="lo-stats__total text-center text-success">$199</td>
                        <td class="lo-stats__actions">
                            <div class="btn-group d-table ml-auto" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-sm btn-white">Cancel</button>
                                <button type="button" class="btn btn-sm btn-white">Edit</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShopOrders",
        data() {
            return {
                orders: [],
                page: 1,
                loaded: false,
                showing: 'all',
                paginatorInfo: null
            }
        },
        methods: {
            fetchOrders() {

            },
            loadPage(page) {
                this.page = page;
                this.fetchOrders();
            }
        },
        watch: {
            showing(data) {
                this.loaded = false;
                this.loadPage(1);
            }
        }
    }
</script>

<style scoped>

</style>