<template>
    <div>
        <div class="header-navbar collapse d-lg-flex p-0 bg-white border-bottom sticky">
            <div class="container p-0">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="#" class="nav-link active"><i class="material-icons">list</i> All</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="material-icons">done</i> Completed</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="material-icons">help</i> Pending</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="material-icons">clear</i> Cancelled</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container py-4">
            <div class="card card-small lo-stats h-100 border">
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
            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Orders"
    }
</script>

<style scoped>

</style>