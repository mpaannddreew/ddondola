<template>
    <div>
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
                                        <input type="text" class="form-control form-control-sm" placeholder="Filter categories">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card card-small border">
                        <div class="card-body p-0 text-center">
                            <table class="table mb-0">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">Name</th>
                                    <th scope="col" class="border-0">Sub Categories</th>
                                    <th scope="col" class="border-0">Products</th>
                                </tr>
                                </thead>
                                <tbody>
                                <template v-if="!loaded">
                                    <tr>
                                        <td colspan="3">
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
                                                    <small>You have not added any categories yet!</small>
                                                </h4>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                                <template v-else-if="showCategories && loaded">
                                    <tr v-for="(category, indx) in categories" :key="indx">
                                        <td>{{ category.name }}</td>
                                        <td>{{ category.categoryCount }}</td>
                                        <td>{{ category.productCount }}</td>
                                    </tr>
                                </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <nav class="my-4">
                        <ul class="pager">
                            <li class="disabled">
                                <a class="btn btn-block btn-pill btn-outline-primary btn-sm" href="#">
                                    <span aria-hidden="true"><i class="fa fa-chevron-left"></i></span> Previous
                                </a>
                            </li>
                            <li class="spacer"></li>
                            <li>
                                <a class="btn btn-block btn-pill btn-outline-primary btn-sm" href="#">
                                    Next <span aria-hidden="true"><i class="fa fa-chevron-right"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-small mb-3" style="background: none !important;">
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
                                <button type="button" class="btn btn-success" :class="{disabled: loading}" @click="validate">Save</button>
                                <button class="btn btn-link p-0" v-show="loading"><div class="loader loader-sm"></div></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShopCategories",
        mounted() {
            this.loadCategories();
        },
        data() {
            return {
                categories: [],
                loaded: false,
                page: 1,
                count: 10,
                name: '',
                description: '',
                error: false,
                loading: false
            }
        },
        computed: {
            showCategories() {
                return this.categories.length > 0;
            }
        },
        props: {
            shop: {
                type: Object,
                required: true
            }
        },
        methods: {
            loadCategories() {
                axios.post(graphql.api, {
                    query: graphql.shopProductCategories,
                    variables: {id: this.shop.id, count: this.count, page: this.page}
                }).then(this.loadData).catch(function () {});
            },
            loadData(response) {
                this.loaded = true;
                this.categories = response.data.data.shop.categories.data;
            },
            validate() {
                if (!this.name.length > 0)
                    this.showError('name', "Category name is required");

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
                this.loading = false;
                this.categories.unshift(response.data.data.category);
                DToast("success", "Category created successfully");
            },
            createCategory() {
                this.loading = true;
                axios.post(graphql.api, {
                    query: graphql.createCategory,
                    variables: {
                        shopId: this.shop.id,
                        category: {
                            name: this.name,
                            description: this.description,
                        }
                    }
                }).then(this.clearForm).catch(function (error) {});
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