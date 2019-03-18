<template>
    <div class="row">
        <div class="col-md-8">
            <div>
                <div class="mb-4">
                    <div class="row no-gutters">
                        <div class="col-lg-3 mb-2 mb-lg-0">
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
                    </div>
                </div>
                <div class="card card-small lo-stats h-100 border">
                    <table class="table mb-0">
                        <thead class="py-2 bg-light text-semibold border-bottom">
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th class="text-center">Products</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template>
                            <tr>
                                <td colspan="3" v-if="!loaded">
                                    <div align="center"><div class="loader"></div></div>
                                </td>
                            </tr>
                        </template>
                        <template v-if="!showCategories && loaded">
                            <tr>
                                <td colspan="3">
                                    <div align="center">
                                        <h4>
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
                                <td class="lo-stats__items">{{ category.name }}</td>
                                <td class="lo-stats__items">{{ category.category.name }}</td>
                                <td class="lo-stats__items text-center">{{ category.productCount }}</td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                </div>
                <pagination v-if="paginatorInfo" class="my-4" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-small mb-3 border"  v-if="!categoriesLoaded">
                <div class="card-body" align="center">
                    <div class="loader"></div>
                </div>
            </div>
            <div class="card card-small mb-3" v-else-if="categoriesLoaded && requirementsLoaded" style="background: none !important;">
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
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><a :href="inventoryUrl + '/categories'" title="Add Category" data-toggle="tooltip"><i class="material-icons">add_circle</i></a></span>
                                </div>
                                <select id="category" class="form-control form-control-md custom-select custom-select-md" tabindex="-1" aria-hidden="true" v-model="categoryId">
                                    <option v-for="(category, indx) in productCategories" :value="category.id" :key="indx">{{ category.name }}</option>
                                </select>
                            </div>
                            <div class="invalid-feedback" id="category_feedback"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control form-control-sm" placeholder="Description" v-model="description"></textarea>
                        </div>
                        <div class="form-group mb-0">
                            <button type="button" class="btn btn-success" :class="{disabled: loading}" @click="validate">Save</button>
                            <button class="btn btn-link p-0" v-show="loading"><div class="loader loader-sm"></div></button>
                        </div>
                    </form>
                </div>
            </div>
            <div align="center" v-else-if="categoriesLoaded && !requirementsLoaded">
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
                DToast("success", "Subcategory created successfully");
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