<template>
    <div>
        <div class="mb-4">
            <div class="row no-gutters">
                <div class="col-12 col-sm-6 mb-2 mb-lg-0">
                    <form action="POST">
                        <div class="input-group input-group-seamless">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="material-icons"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control form-control-sm" placeholder="Filter sub categories">
                        </div>
                    </form>
                </div>
                <div class="col-12 col-sm-6 d-flex align-items-center">
                    <div class="btn-group btn-group-sm ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" role="group" aria-label="Table row actions">
                        <a href="#new-subcategory" data-toggle="modal" class="btn btn-success">
                            <i class="material-icons">add</i> New Sub Category
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-small lo-stats h-100 border">
            <table class="table mb-0">
                <thead class="py-2 bg-light text-semibold border-bottom">
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th class="text-center">Products</th>
                    <th>Description</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <template>
                    <tr>
                        <td colspan="4" v-if="!loaded">
                            <div align="center"><div class="loader"></div></div>
                        </td>
                    </tr>
                </template>
                <template v-if="!showCategories && loaded">
                    <tr>
                        <td colspan="4">
                            <div align="center">
                                <h4 class="m-0">
                                    <i class="material-icons">error_outline</i>
                                    <br />
                                    <small>You have not added any subcategories yet!</small>
                                </h4>
                            </div>
                        </td>
                    </tr>
                </template>
                <template v-else-if="showCategories && loaded">
                    <tr v-for="(category, indx) in categories" :key="indx">
                        <td>{{ category.name }}</td>
                        <td>{{ category.category.name }}</td>
                        <td class="text-center">{{ category.productCount }}</td>
                        <td></td>
                        <td>
                            <div class="btn-group d-table ml-auto" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-sm btn-white"><i class="fa fa-edit text-info"></i></button>
                                <button type="button" class="btn btn-sm btn-white"><i class="fa fa-trash text-danger"></i></button>
                            </div>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
        <pagination v-if="paginatorInfo" class="my-4" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
        <div class="modal fade" id="new-subcategory" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-small" v-if="!categoriesLoaded">
                            <div class="card-body" align="center">
                                <div class="loader"></div>
                            </div>
                        </div>
                        <div class="card card-small" v-else-if="categoriesLoaded && !requirementsLoaded">
                            <div class="card-body" align="center">
                                <div align="center">
                                    <h4>
                                        <i class="material-icons">error_outline</i>
                                        <br />
                                        <small>You have not added any categories yet!</small>
                                        <br />
                                        <a :href="inventoryUrl + '/categories'" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Add Categories</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="card card-small" v-else-if="categoriesLoaded && requirementsLoaded" style="background: none !important;">
                            <div class="card-header border-bottom">
                                <h6 class="m-0"><i class="material-icons">add</i> New Sub Category</h6>
                            </div>
                            <div class="card-body">
                                <form class="add-new-post">
                                    <div class="form-group">
                                        <input class="form-control form-control-sm" type="text" placeholder="Name" v-model="name" id="name">
                                        <div class="invalid-feedback" id="name_feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <select id="category" class="form-control form-control-md custom-select custom-select-md" tabindex="-1" aria-hidden="true" v-model="categoryId">
                                            <option v-for="(category, indx) in productCategories" :value="category.id" :key="indx">{{ category.name }}</option>
                                        </select>
                                        <div class="invalid-feedback" id="category_feedback"></div>
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
    export default {
        name: "ShopSubCategories",
        mounted() {
            this.loadCategories();
        },
        data() {
            return {
                categories: [],
                productCategories: [],
                loaded: false,
                categoriesLoaded: false,
                page: 1,
                count: 10,
                name: '',
                description: '',
                categoryId: '',
                loading: false,
                error: false,
                paginatorInfo: null
            }
        },
        computed: {
            showCategories() {
                return this.categories.length > 0;
            },
            requirementsLoaded() {
                return this.productCategories.length > 0;
            }
        },
        props: {
            shop: {
                type: Object,
                required: true
            },
            inventoryUrl: {
                type: String,
                required: true
            }
        },
        methods: {
            categoryRequest() {
                return axios.post(graphql.api, {
                    query: graphql.shopProductCategories,
                    variables: {id: this.shop.id, count: 50, page: 1}
                });
            },
            subcategoryRequest() {
                return axios.post(graphql.api, {
                    query: graphql.shopProductSubCategories,
                    variables: {id: this.shop.id, count: this.count, page: this.page}
                });
            },
            loadCategories() {
                let requests = [this.subcategoryRequest(), this.categoryRequest()];
                axios.all(requests).then(axios.spread(this.spreadResponse));
            },
            refreshSubCaregories() {
                this.subcategoryRequest().then(this.loadData).catch(function (error) {})
            },
            spreadResponse(subcategories, categories) {
                this.loadData(subcategories);
                this.loadCategoryData(categories);
            },
            loadData(response) {
                this.loaded = true;
                this.categories = response.data.data.shop.categories.data;
                this.paginatorInfo = response.data.data.shop.categories.paginatorInfo;
            },
            loadCategoryData(response) {
                this.categoriesLoaded = true;
                this.productCategories = response.data.data.shop.categories.data;
            },
            validate() {
                if (!this.name.length > 0)
                    this.showError('name', "Subcategory name is required");

                if (!this.name.length > 0)
                    this.showError('category', "Choose a category");

                if (!this.error) {
                    this.createCategory();
                }
            },
            clearError(id) {
                $('#' + id).removeClass('is-invalid');
                $('#' + id + "_feedback").hide();
                this.error = false;
            },
            showError(id, message) {
                $('#' + id).addClass('is-invalid');
                $('#' + id + "_feedback").text(message).show();
                this.error = true;
                this.loading = false;
            },
            clearForm(response) {
                this.name = '';
                this.description = '';
                this.categoryId = '';
                this.loading = false;
                $("#new-subcategory").modal('hide');
                DToast("success", "Subcategory created successfully");
                this.loadPage(1);
            },
            createCategory() {
                this.loading = true;
                axios.post(graphql.api, {
                    query: graphql.createSubCategory,
                    variables: {
                        categoryId: this.categoryId,
                        subcategory: {
                            name: this.name,
                            description: this.description,
                        }
                    }
                }).then(this.clearForm).catch(function (error) {});
            },
            loadPage(page) {
                this.page = page;
                this.refreshSubCaregories();
            }
        },
        watch: {
            name: function (data) {
                if (data.length > 0) {
                    this.clearError("name");
                }
            },
            categoryId: function (data) {
                if (data.length > 0) {
                    this.clearError("category");
                }
            }
        }
    }
</script>

<style scoped>

</style>