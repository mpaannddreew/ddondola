<template>
    <div>
        <div class="header-navbar collapse d-lg-flex p-0 bg-white border-bottom sticky">
            <div class="container p-0">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link" @click="showAll" :class="{ active: isShowing('all') }" ><i class="material-icons">list</i> All</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link" @click="showCompleted" :class="{ active: isShowing('completed') }" ><i class="material-icons">done</i> Completed</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link" @click="showPending" :class="{ active: isShowing('pending') }" ><i class="material-icons">help</i> Pending</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link" @click="showCancelled" :class="{ active: isShowing('cancelled') }" ><i class="material-icons">clear</i> Cancelled</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container py-2">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-sm-left mb-4 mb-sm-0">
                    <div class="input-daterange input-group input-group-md w-100">
                        <input type="text" class="input-sm form-control form-control-sm" name="start" placeholder="Start Date">
                        <input type="text" class="input-sm form-control form-control-sm" name="end" placeholder="End Date">
                        <span class="input-group-append">
                        <span class="input-group-text">
                              <i class="material-icons"></i>
                            </span>
                        </span>
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
        name: "Orders",
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
            showAll() {
                this.loaded = false;
                this.showing = 'all';
                this.loadPage(1);
            },
            showCompleted() {
                this.loaded = false;
                this.showing = 'completed';
                this.loadPage(1);
            },
            showPending() {
                this.loaded = false;
                this.showing = 'pending';
                this.loadPage(1);
            },
            showCancelled() {
                this.loaded = false;
                this.showing = 'cancelled';
                this.loadPage(1);
            },
            loadPage(page) {
                this.page = page;
                this.fetchOrders();
            },
            isShowing(type) {
                return this.showing === type;
            }
        }
    }
</script>

<style scoped>

</style>