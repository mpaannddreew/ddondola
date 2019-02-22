<template>
    <div>
        <div class="card card-small mb-3 background-0">
            <div class="row no-gutters">
                <div class="col-lg-3 my-2 my-lg-0">
                    <form action="POST">
                        <div class="input-group input-group-seamless">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="material-icons"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control form-control-sm" placeholder="Filter shops">
                        </div>
                    </form>
                </div>
                <div class="col">
                    <div class="d-flex ml-lg-auto my-auto">
                        <div class="btn-group btn-group-sm mr-2 ml-lg-auto" role="group" aria-label="Table row actions">
                            <button type="button" class="btn btn-white" :class="{active: all}" @click="showAll">
                                <i class="fa fa-check-circle"></i> all
                            </button>
                            <button type="button" class="btn btn-white" :class="{active: active}" @click="showActive">
                                <i class="fa fa-dot-circle-o text-success"></i> active
                            </button>
                            <button type="button" class="btn btn-white" :class="{active: inactive}" @click="showInactive">
                                <i class="fa fa-dot-circle-o text-danger"></i> inactive
                            </button>
                        </div>
                        <a href="#" class="btn btn-sm btn-success d-inline-block ml-auto ml-lg-0">
                            <i class="fa fa-plus"></i> Add New
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-small lo-stats h-100 border">
            <table class="table mb-0">
                <thead class="py-2 bg-light text-semibold border-bottom">
                <tr>
                    <th>Details</th>
                    <th></th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Products</th>
                    <!--<th class="text-center">Total</th>-->
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr is="shop" v-for="(indx, shop) in shops"></tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import Shop from "./shops/ShopRow";
    import ShopFilter from "./filters/ShopFilter";
    export default {
        name: "UserShops",
        components: {ShopFilter, Shop},
        data() {
            return {
                shops: [1],
                all: true,
                active: false,
                inactive: false
            }
        },
        methods: {
            showAll() {
                this.all = true;
                this.active = false;
                this.inactive = false;
            },
            showActive() {
                this.all = false;
                this.active = true;
                this.inactive = false;
            },
            showInactive() {
                this.all = false;
                this.active = false;
                this.inactive = true;
            }
        }
    }
</script>

<style scoped>

</style>