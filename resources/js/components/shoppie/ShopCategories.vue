<template>
    <div>
        <div>
            <div class="mb-2">
                <div class="row no-gutters">
                    <div class="col-12 col-sm-6 mb-2 mb-lg-0">
                        <form class="ddondola-search">
                            <div class="input-group input-group-seamless">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="material-icons"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control form-control-sm" placeholder="Filter categories" id="search_categories">
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-sm-6 d-flex align-items-center">
                        <div class="btn-group btn-group-sm ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" role="group" aria-label="Table row actions">
                            <a href="#new-category" data-toggle="modal" class="btn btn-success">
                                <i class="material-icons">add</i> New Category
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-small lo-stats h-100 border border-top-radius-0">
                <table class="table mb-0">
                    <thead class="py-2 bg-light text-semibold border-bottom">
                    <tr>
                        <th>Name</th>
                        <th>Sub Categories</th>
                        <th class="text-center">Products</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-if="!loaded || (!showCategories && loaded)">
                        <tr>
                            <td colspan="5">
                                <div align="center" v-if="!loaded">
                                    <div class="loader"></div>
                                    <p class="m-0">Loading categories...</p>
                                </div>
                                <div align="center" v-if="!showCategories && loaded">
                                    <h4 class="m-0"><i class="material-icons">error</i></h4>
                                    <p class="m-0">You have not added any categories yet!</p>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <template v-else-if="showCategories && loaded">
                        <tr is="shop-category" v-for="(category, indx) in categories" :category="category" :key="indx" v-on:done-saving="loadCategories"></tr>
                    </template>
                    </tbody>
                </table>
            </div>
        </div>
        <pagination v-if="paginatorInfo" class="my-2" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
        <div class="modal fade" id="new-category" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-small">
                            <div class="card-header border-bottom">
                                <h6 class="m-0"><i class="material-icons">add</i> New Category</h6>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <input class="form-control form-control-sm" type="text" placeholder="Name" v-model="name" id="name">
                                        <div class="invalid-feedback" id="name_feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control form-control-sm" placeholder="Description" v-model="description"></textarea>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="button" class="btn btn-md btn-pill btn-outline-primary" :class="{disabled: loading}" @click="validate"><i class="material-icons">check</i> Save</button>
                                        <button class="btn btn-link p-0" v-show="loading"><div class="loader loader-sm"></div></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ShopCategory from "./inventory/ShopCategory";
    export default {
        name: "ShopCategories",
        components: {ShopCategory},
        mounted() {
            this.loadCategories();
        },
        data() {
            return {
                categories: [],
                loaded: false,
                page: 1,
                name: '',
                description: '',
                error: false,
                loading: false,
                paginatorInfo: null
            }
        },
        computed: {
            showCategories() {
                return this.categories.length > 0;
            }
        },
        props: {
            shop: {
                type: String,
                required: true
            }
        },
        methods: {
            loadCategories() {
                this.loaded = false;
                this.categories = [];
                axios.post(graphql.api, {
                    query: graphql.shopProductCategories,
                    variables: {shop: this.shop, count: graphql.rowCount, page: this.page}
                }).then(this.loadData).catch(function () {});
            },
            loadData(response) {
                this.loaded = true;
                this.categories = response.data.data.shop.categories.data;
                this.paginatorInfo = response.data.data.shop.categories.paginatorInfo;
            },
            validate() {
                if (!this.name.length > 0)
                    this.showError('name', "Category name is required");

                if (!this.error) {
                    this.createCategory();
                }
            },
            clearError(id) {
                $(`#${id}`).removeClass('is-invalid');
                $(`#${id}_feedback`).hide();
                this.error = false;
            },
            showError(id, message) {
                $(`#${id}`).addClass('is-invalid');
                $(`#${id}_feedback`).text(message).show();
                this.error = true;
                this.loading = false;
            },
            clearForm(response) {
                this.name = '';
                this.description = '';
                this.loading = false;
                DToast("success", "Category created successfully");
                $("#new-category").modal('hide');
                this.loadPage(1);
            },
            createCategory() {
                this.loading = true;
                axios.post(graphql.api, {
                    query: graphql.createCategory,
                    variables: {
                        shop: this.shop,
                        category: {
                            name: this.name,
                            description: this.description,
                        }
                    }
                }).then(this.clearForm).catch(function (error) {});
            },
            loadPage(page) {
                this.page = page;
                this.loadCategories();
            }
        },
        watch: {
            name: function (data) {
                if (data.length > 0) {
                    this.clearError("name");
                }
            }
        }
    }
</script>

<style scoped>

</style>