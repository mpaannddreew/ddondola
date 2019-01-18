<template>
    <div class="pb-4">
        <div class="card card-small mb-3 background-0">
            <div class="row no-gutters">
                <div class="col-lg-3 mb-2 mb-lg-0 pr-2">
                    <div class="input-group input-group-seamless">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="material-icons">search</i>
                            </div>
                        </div>
                        <input type="text" class="form-control form-control-sm" placeholder="Search files">
                    </div>
                </div>
                <div class="col-lg-3 mb-2 mb-lg-0 pr-2">
                    <div class="input-group input-group-seamless">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-folder"></i>
                            </div>
                        </div>
                        <select class="form-control form-control-sm">
                            <option value="menu_order" selected="selected">Categories</option>
                            <option value="popularity">Sort by popularity</option>
                            <option value="rating">Sort by average rating</option>
                            <option value="date">Sort by newness</option>
                            <option value="price">Sort by price: low to high</option>
                            <option value="price-desc">Sort by price: high to low</option>
                        </select>
                    </div>
                </div>
                <div class="col text-right view-report">
                    <p class="m-0 pr-2">Showing 10 of 120</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" v-for="(indx, shop) in shops">
                <div is="shop"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import Shop from "./shops/Shop";
    export default {
        name: "Shops",
        components: {Shop},
        data() {
            return {
                shops: [1, 2, 3, 4]
            }
        },
        methods: {

        }
    }
</script>

<style scoped>

</style>