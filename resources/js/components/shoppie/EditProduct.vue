<template>
    <div>
        <div class="card card-small border" v-if="!loaded || (loaded && !requirementsLoaded)">
            <div class="card-body">
                <div align="center" v-if="!loaded">
                    <div class="loader"></div>
                    <p class="m-0">Loading product...</p>
                </div>
                <div align="center" v-if="loaded && !requirementsLoaded">
                    <h4 class="m-0"><i class="material-icons">error</i></h4>
                    <p class="mb-3">An error occurred!</p>
                    <a href="javascript:void(0)" class="btn btn-success btn-pill" @click="loadShopCategoriesAndBrands"><i class="fa fa-refresh"></i> Reload</a>
                </div>
            </div>
        </div>
        <div class="checkout-process" v-else-if="loaded && requirementsLoaded">
            <div class="card mb-2">
                <div class="card-header form-wizard-step border-right border-top border-top-right-radius-0">
                    <h5>
                        <a class="btn btn-link" href="javascript:void(0)">
                            <span><i class="material-icons">more_vert</i></span>
                            <i class="material-icons">info</i> General Information
                        </a>
                    </h5>
                </div>
                <div class="card-body p-4 border border-top-0">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control" id="name" v-model="name">
                            <div class="invalid-feedback" id="name_feedback"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="category">Product Category</label>
                            <select id="category" class="form-control form-control-md custom-select custom-select-md" tabindex="-1" aria-hidden="true" v-model="categoryId">
                                <option v-for="(category, indx) in categories" :value="category.id" :key="indx">{{ category.name }}</option>
                            </select>
                            <div class="invalid-feedback" id="category_feedback"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="subCategory">Product Sub Category</label>
                            <select id="subCategory" class="form-control form-control-md custom-select custom-select-md" tabindex="-1" aria-hidden="true" v-model="subCategoryId">
                                <option v-for="(category, indx) in subCategories" :value="category.id" :key="indx">{{ category.name }}</option>
                            </select>
                            <div class="invalid-feedback" id="subCategory_feedback"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="brand">Product Brand</label>
                            <select id="brand" class="form-control form-control-md custom-select custom-select-md" tabindex="-1" aria-hidden="true" v-model="brandId">
                                <option v-for="(brand, indx) in brands" :value="brand.id" :key="indx">{{ brand.name }}</option>
                            </select>
                            <div class="invalid-feedback" id="brand_feedback"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="price">General Price</label>
                            <input type="text" class="form-control" id="price" v-model="price" :placeholder="product.currency_code">
                            <div class="invalid-feedback" id="price_feedback"></div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="description">Product Description</label>
                            <textarea style="min-height: 87px;" id="description" class="form-control" v-model="description"></textarea>
                            <div class="invalid-feedback" id="description_feedback"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-2" id="attributes">
                <div class="card-header form-wizard-step border-right border-top border-top-right-radius-0">
                    <h5>
                        <a class="btn btn-link" href="javascript:void(0)">
                            <span><i class="material-icons">more_vert</i></span>
                            <i class="material-icons">create</i> Product Specifications
                        </a>
                    </h5>
                </div>
                <div class="card-body p-4 border border-top-0">
                    <div class="form-row" v-for="(attribute, indx) in attributes" :key="indx">
                        <div class="form-group col-md-5">
                            <input type="text" class="form-control" placeholder="Name" v-model="attribute.name" :id="indx + '_name'">
                            <div class="invalid-feedback" :id="indx + '_name_feedback'"></div>
                        </div>
                        <div class="form-group col-md-5">
                            <input type="text" class="form-control" placeholder="Value" v-model="attribute.value" :id="indx + '_value'">
                            <div class="invalid-feedback" :id="indx + '_value_feedback'"></div>
                        </div>
                        <div class="form-group col-md-2 p-0">
                            <button type="button" class="btn btn-sm btn-success" @click="addRow">
                                <i class="material-icons">add</i> Add
                            </button>
                            <button type="button" class="btn btn-sm btn-link text-danger" v-if="showRemove" @click="removeRow(indx)">
                                <i class="material-icons">clear</i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-wizard-buttons text-md-right">
                <button type="button" class="btn btn-lg btn-pill btn-outline-primary" :class="{disabled: loading}" @click="validate">
                    <i class="material-icons">check</i> Update Product
                </button>
                <button class="btn btn-link p-0" v-show="loading"><div class="loader loader-sm"></div></button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EditProduct",
        mounted() {
            this.loadShopCategoriesAndBrands();
        },
        data() {
            return {
                name: '',
                categories: [],
                categoryId: '',
                subCategories: [],
                subCategoriesCount: 0,
                subCategoryId: '',
                brands: [],
                brandId: '',
                description: '',
                status: 1,
                loaded: false,
                loading: false,
                error: false,
                attributes: [{name: '', value: ''}],
                price: ''
            }
        },
        props: {
            product: {
                type: Object,
                required: true
            }
        },
        methods: {
            loadProduct() {
                this.name = this.product.name;
                this.categoryId = this.product.sub_category.category.id;
                this.subCategoryId = this.product.sub_category.id;
                this.brandId = this.product.brand_id;
                this.description = this.product.description;
                this.status = this.product.active ? 1:0;
                this.attributes = Collect(this.product.settings).get('attributes', [{name: '', value: ''}]);
                this.price = this.product.price;
            },
            loadShopCategoriesAndBrands() {
                this.loaded = false;
                axios.post(graphql.api, {
                    query: graphql.shopCategoriesAndBrands,
                    variables: {id: this.product.sub_category.category.shop.id, count: 50, page: 1}
                }).then(this.loadData).catch(function (error) {});
            },
            loadData(response) {
                this.loaded = true;
                this.subCategoriesCount = response.data.data.shop.subCategoriesCount;
                this.categories = response.data.data.shop.categories.data;
                this.brands = response.data.data.shop.brands.data;
                this.loadProduct();
            },
            editProduct() {
                this.loading = true;
                axios.post(graphql.api, {
                    query: graphql.editProduct,
                    variables: {
                        productId: this.product.id,
                        product: {
                            brandId: this.brandId,
                            categoryId: this.subCategoryId,
                            price: this.price,
                            description: this.description,
                            name: this.name,
                            active: !!this.status,
                            attributes: this.attributes
                        }
                    }
                }).then(this.clearForm).catch(function (error) {});
            },
            validate() {
                this.loading = true;

                if (!this.name.length > 0)
                    this.showError('name', "Product name is required");

                if (!this.categoryId.length > 0)
                    this.showError('category', "Please choose a category");

                if (!this.subCategoryId.length > 0)
                    this.showError('subCategory', "Please choose a subcategory");

                if (!this.brandId.length > 0)
                    this.showError('brand', "Please choose a brand");

                if (!this.price.length > 0)
                    this.showError('price', "Product general price is required");

                if (!this.description.length > 0)
                    this.showError('description', "Product description is required");

                this.validateAttributes();

                if (!this.error) {
                    this.editProduct();
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
                this.loading = false;
                DToast("success", "Product updated successfully")
            },
            addRow() {
                if (this.numberOfAttributes < 10) {
                    this.attributes.push({name: '', value: ''});
                } else {
                    DToast('error', "Only 10 attributes are supported")
                }
            },
            removeRow(index) {
                if (this.numberOfAttributes > 1) {
                    this.attributes.splice(index, 1)
                }
            },
            validateAttributes() {
                for(var i = 0; i < this.numberOfAttributes; i++) {
                    var name = i + '_name';
                    var value = i + '_value';
                    if (!$("#" + name).val().length > 0)
                        this.showError(name, "Specification name is required");

                    if (!$("#" + value).val().length > 0)
                        this.showError(value, "Specification value is required");
                }
            }
        },
        watch: {
            name(data) {
                if (data) {
                    this.clearError('name');
                }
            },
            price(data) {
                if (data) {
                    this.clearError('price');
                }
            },
            brandId(data) {
                if (data) {
                    this.clearError('brand');
                }
            },
            categoryId(data) {
                if (data) {
                    this.clearError('category');
                    var category = _.first(this.categories, function (value) {
                        return value.id === data;
                    });
                    this.subCategories = category.categories;
                }
            },
            subCategoryId(data) {
                if (data) {
                    this.clearError('subCategory');
                }
            },
            attributes: {
                handler(data) {
                    for(var i = 0; i < this.numberOfAttributes; i++) {
                        this.clearError(i + '_name');
                        this.clearError(i + '_value');
                    }
                },
                deep: true
            }
        },
        computed: {
            numberOfAttributes() {
                return this.attributes.length;
            },
            showRemove() {
                return this.numberOfAttributes > 1;
            },
            requirementsLoaded() {
                return this.hasCategories && this.hasSubCategories && this.hasBrands;
            },
            hasCategories() {
                return this.categories.length > 0;
            },
            hasSubCategories() {
                return this.subCategoriesCount > 0;
            },
            hasBrands() {
                return this.brands.length > 0;
            }
        }
    }
</script>

<style scoped>
    div#attributes .form-row:last-child .form-group {
        margin-bottom: 0 !important;
    }
</style>