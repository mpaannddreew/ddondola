<template>
    <div>
        <div class="card card-small mb-4 border">
            <div class="row no-gutters p-2">
                <div class="col-lg-3 mb-2 mb-lg-0">
                    <form action="POST">
                        <div class="input-group input-group-seamless">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="material-icons"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control form-control-sm file-manager-cards__search" placeholder="Filter products">
                        </div>
                    </form>
                </div>
                <div class="col">
                    <div class="d-flex ml-lg-auto my-auto">
                        <div class="btn-group btn-group-sm mr-2 ml-lg-auto" role="group" aria-label="Table row actions">
                            <button type="button" class="btn btn-white">
                                <i class="material-icons"></i>
                            </button>
                            <button type="button" class="btn btn-white">
                                <i class="material-icons"></i>
                            </button>
                            <button type="button" class="btn btn-white">
                                <i class="material-icons"></i>
                            </button>
                            <button type="button" class="btn btn-white">
                                <i class="material-icons"></i>
                            </button>
                        </div>
                        <button class="btn btn-sm btn-accent d-inline-block ml-auto ml-lg-0">
                            <i class="fa fa-plus"></i> Add New Product </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-small lo-stats h-100 mb-4 border">
            <table class="table mb-0">
                <thead class="py-2 bg-light text-semibold border-bottom">
                <tr>
                    <th>Details</th>
                    <th></th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr is="inventory-row" v-for="(indx, product) in products"></tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import InventoryRow from "./inventory/InventoryRow";
    export default {
        name: "ShopInventory",
        components: {InventoryRow},
        data() {
            return {
                products: [1]
            }
        }
    }
</script>

<style scoped>

</style>