<template>
    <div class="directory-list close-directory-list">
        <div class="card card-small h-100 border-right main">
            <div class="card-header border-bottom border-top-radius-0 bg-light">
                <div class="input-group input-group-seamless">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <input class="form-control" type="text" :placeholder="placeholder"  aria-label="Search" v-model="filter">
                </div>
            </div>
            <div class="card-body h-100" style="overflow: hidden;">
                <div class="header-navbar collapse d-lg-flex p-0 bg-light border-bottom">
                    <div class="container p-0">
                        <div class="row">
                            <div class="col">
                                <ul class="nav nav-tabs nav-justified border-0 flex-column flex-lg-row">
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" class="nav-link" :class="{active: categoriesActive}" @click="showCategories"><i class="material-icons">folder_open</i> Categories</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" class="nav-link" :class="{active: !categoriesActive}" @click="showBrands"><i class="material-icons">check_box</i> Brands</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <shop-product-categories :shop="shop" :admin="admin" v-if="categoriesActive"></shop-product-categories>
                <shop-product-brands :shop="shop" :admin="admin" v-else></shop-product-brands>
            </div>
        </div>
    </div>
</template>

<script>
    import ShopProductCategories from "./ShopProductCategories";
    import ShopProductBrands from "./ShopProductBrands";
    export default {
        name: "ShopProductFilters",
        components: {ShopProductBrands, ShopProductCategories},
        data() {
            return {
                categoriesActive: true,
                filter: ''
            }
        },
        props: {
            admin: {
                type: Boolean,
                default: false
            },
            shop: {
                type: String,
                required: true
            }
        },
        computed: {
            placeholder() {
                return this.categoriesActive ? "Filter Categories": "Filter Brands";
            }
        },
        methods: {
            showCategories() {
                this.categoriesActive = true;
            },
            showBrands() {
                this.categoriesActive = false;
            }
        },
        watch: {
            categoriesActive(data) {
                this.filter = '';
            },
            filter(data) {
                Bus.$emit("filter", data);
            }
        }
    }
</script>

<style scoped>
    .directory-list .close-directory-list .card.main {
        height: calc(99.9vh - 7.05rem - 1px) !important;
    }

    .nav-link {
        margin: 0 !important;
    }

    .nav-item {
        border-right:1px solid #e1e5eb!important;
    }

    .nav-item:last-child {
        border-right: none !important;
    }
</style>