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
                                    <input type="text" class="form-control form-control-sm" placeholder="Filter brands">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card card-small lo-stats h-100 border">
                    <table class="table mb-0 ">
                        <thead class="py-2 bg-light text-semibold border-bottom">
                        <tr>
                            <th>Name</th>
                            <th class="text-center">Products</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-if="!loaded">
                            <tr>
                                <td colspan="2">
                                    <div align="center"><div class="loader"></div></div>
                                </td>
                            </tr>
                        </template>
                        <template v-else-if="!showBrands && loaded">
                            <tr>
                                <td colspan="2">
                                    <div align="center">
                                        <h4>
                                            <i class="material-icons">error_outline</i>
                                            <br />
                                            <small>You have not added any brands yet!</small>
                                        </h4>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <template v-else-if="showBrands && loaded">
                            <tr v-for="(brand, indx) in brands">
                                <td>{{ brand.name }}</td>
                                <td class="lo-stats__items text-center">{{ brand.productCount }}</td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                </div>
                <pagination v-if="paginatorInfo" class="my-4" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-small mb-3" style="background: none !important;">
                <div class="card-header border-bottom">
                    <h6 class="m-0"><i class="material-icons">add</i> New Brand</h6>
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
</template>

<script>
    export default {
        name: "ShopBrands",
        mounted() {
            this.loadBrands();
        },
        data() {
            return {
                brands: [],
                loaded: false,
                page: 1,
                count: 10,
                name: '',
                description: '',
                loading: false,
                error: false,
                paginatorInfo: null
            }
        },
        computed: {
            showBrands() {
                return this.brands.length > 0;
            }
        },
        props: {
            shop: {
                type: Object,
                required: true
            }
        },
        methods: {
            loadBrands() {
                axios.post(graphql.api, {
                    query: graphql.shopProductBrands,
                    variables: {id: this.shop.id, count: this.count, page: this.page}
                }).then(this.loadData).catch(function () {});
            },
            loadData(response) {
                this.loaded = true;
                this.brands = response.data.data.shop.brands.data;
                this.paginatorInfo = response.data.data.shop.brands.paginatorInfo;
            },
            validate() {
                if (!this.name.length > 0)
                    this.showError('name', "Brand name is required");

                if (!this.error) {
                    this.createBrand();
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
                DToast("success", "Brand created successfully");
            },
            createBrand() {
                this.loading = true;
                axios.post(graphql.api, {
                    query: graphql.createBrand,
                    variables: {
                        shopId: this.shop.id,
                        brand: {
                            name: this.name,
                            description: this.description,
                        }
                    }
                }).then(this.clearForm).catch(function (error) {});
            },
            loadPage(page) {
                this.page = page;
                this.loadBrands();
            }
        },
        watch: {
            name(data) {
                if (data.length > 0) {
                    this.clearError("name");
                }
            }
        }
    }
</script>

<style scoped>

</style>