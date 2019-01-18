<template>
    <div class=" pt-4">
        <div class="card card-small mb-3 background-0">
            <div class="row no-gutters">
                <div class="col-lg-3 mb-2 mb-lg-0 pr-2">
                    <form action="POST">
                        <div class="input-group input-group-seamless">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="material-icons"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control form-control-sm" placeholder="Search files">
                        </div>
                    </form>
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
                <div class="col">
                    <div class="d-flex ml-lg-auto my-auto">
                        <div class="btn-group btn-group-sm mr-2 ml-lg-auto" role="group" aria-label="Table row actions">
                            <button type="button" class="btn btn-white" :class="{active: all}" @click="showAll">
                                <i class="fa fa-check-circle"></i> All
                            </button>
                            <button type="button" class="btn btn-white" :class="{active: published}" @click="showPublished">
                                <i class="fa fa-dot-circle-o text-success"></i> Published
                            </button>
                            <button type="button" class="btn btn-white" :class="{active: inactive}" @click="showInactive">
                                <i class="fa fa-dot-circle-o text-danger"></i> Inactive
                            </button>
                        </div>
                        <a href="#" class="btn btn-sm btn-success d-inline-block ml-auto ml-lg-0">
                            <i class="fa fa-plus"></i> Add New
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4" v-for="(indx, shop) in shops">
                <div is="shop"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import Shop from "./shops/Shop";
    export default {
        name: "UserShops",
        components: {Shop},
        data() {
            return {
                shops: [1, 2, 3, 4],
                all: true,
                published: false,
                inactive: false
            }
        },
        methods: {
            showAll() {
                this.all = true;
                this.published = false;
                this.inactive = false;
            },
            showPublished() {
                this.all = false;
                this.published = true;
                this.inactive = false;
            },
            showInactive() {
                this.all = false;
                this.published = false;
                this.inactive = true;
            }
        }
    }
</script>

<style scoped>

</style>