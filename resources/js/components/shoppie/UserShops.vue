<template>
    <div class="row">
        <div class="col-md-3">
            <div class="card border p-4">
                <h6>Filters </h6>
                <div class="collapse show" id="collapseFilters">
                    <div class="filter_type">
                        <h6>Category</h6>
                        <ul>
                            <li>
                                <label class="container_check">Restaurants
                                    <small>43</small>
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_check">Shops
                                    <small>33</small>
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_check">Bars
                                    <small>12</small>
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_check">Events
                                    <small>44</small>
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="filter_type">
                        <h6>Rating</h6>
                        <ul>
                            <li>
                                <label class="container_check">Superb 9+
                                    <small>34</small>
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_check">Very Good 8+
                                    <small>21</small>
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_check">Good 7+
                                    <small>15</small>
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_check">Pleasant 6+
                                    <small>34</small>
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--/collapse -->
            </div>
        </div>
        <div class="col-md-9">
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
                    <div class="col-md-6" v-for="(indx, shop) in shops">
                        <div is="shop"></div>
                    </div>
                </div>
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