<template>
    <div class="products-grid p-0">
        <div class="card card-small mb-4 background-0">
            <div class="row no-gutters">
                <div class="col-lg-3 mr-2 mb-2 mb-lg-0">
                    <div class="input-group input-group-seamless">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="material-icons">search</i>
                            </div>
                        </div>
                        <input type="text" class="form-control form-control-sm" placeholder="Search products">
                    </div>
                </div>
                <div class="col-lg-3 mr-2 mb-2 mb-lg-0">
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
                <div class="col-lg-3 mr-2 mb-2 mb-lg-0">
                    <div class="input-group input-group-seamless">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-sort"></i>
                            </div>
                        </div>
                        <select class="form-control form-control-sm">
                            <option value="menu_order" selected="selected">Default sorting</option>
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
            <div class="item col-xl-4 col-md-6" v-for="(indx, product) in products">
                <div is="shop-product"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import ShopProduct from "./products/ShopProduct";
    export default {
        name: "Products",
        components: {ShopProduct},
        data() {
            return {
                products: [1, 2, 3, 4, 5, 6, 7, 8]
            }
        }
    }
</script>

<style scoped>

</style>