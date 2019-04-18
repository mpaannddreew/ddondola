<template>
    <div>
        <div class="card card-small border" v-if="!loaded">
            <div class="card-body">
                <div align="center"><div class="loader"></div></div>
            </div>
        </div>
        <div class="card card-small border" v-else-if="loaded && !requirementsLoaded">
            <div class="card-body">
                <div align="center">
                    <h4>
                        <i class="material-icons">error_outline</i>
                        <br />
                        <small>You have not added any {{ infoText }} yet!</small>
                        <br />
                        <a :href="inventoryUrl + '/' + addUrl" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Add {{ infoTextUpper }}</a>
                    </h4>
                </div>
            </div>
        </div>
        <div class="checkout-process" v-else-if="loaded && requirementsLoaded">
            <div class="card mb-2">
                <div class="card-header form-wizard-step border-right border-top border-top-right-radius-0">
                    <h5>
                        <a class="btn btn-link" href="javascript:void(0)">
                            <span>01</span><i class="material-icons">info</i> General Information
                        </a>
                    </h5>
                </div>
                <div class="card-body p-4 border border-top-0">
                    <div class="form-row">
                        <div class="col-lg-12">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name">Product Name</label>
                                    <input type="text" class="form-control" id="name" v-model="name">
                                    <div class="invalid-feedback" id="name_feedback"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="category">Product Category</label>
                                    <div class="input-group input-group-seamless">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="material-icons">folder</i>
                                            </div>
                                        </div>
                                        <select id="category" class="form-control form-control-md custom-select custom-select-md" tabindex="-1" aria-hidden="true" v-model="categoryId">
                                            <option v-for="(category, indx) in categories" :value="category.id" :key="indx">{{ category.name }}</option>
                                        </select>
                                    </div>
                                    <div class="invalid-feedback" id="category_feedback"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="subCategory">Product Sub Category</label>
                                    <div class="input-group input-group-seamless">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="material-icons">folder</i>
                                            </div>
                                        </div>
                                        <select id="subCategory" class="form-control form-control-md custom-select custom-select-md" tabindex="-1" aria-hidden="true" v-model="subCategoryId">
                                            <option v-for="(category, indx) in subCategories" :value="category.id" :key="indx">{{ category.name }}</option>
                                        </select>
                                    </div>
                                    <div class="invalid-feedback" id="subCategory_feedback"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="brand">Product Brand</label>
                                    <div class="input-group input-group-seamless">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="material-icons">folder</i>
                                            </div>
                                        </div>
                                        <select id="brand" class="form-control form-control-md custom-select custom-select-md" tabindex="-1" aria-hidden="true" v-model="brandId">
                                            <option v-for="(brand, indx) in brands" :value="brand.id" :key="indx">{{ brand.name }}</option>
                                        </select>
                                    </div>
                                    <div class="invalid-feedback" id="brand_feedback"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="price">General Price</label>
                                    <input type="text" class="form-control" id="price" v-model="price" :placeholder="shop.currency_code">
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
                </div>
            </div>
            <div class="card mb-2" id="attributes">
                <div class="card-header form-wizard-step border-right border-top border-top-right-radius-0">
                    <h5>
                        <a class="btn btn-link" href="javascript:void(0)"><span>02</span><i class="material-icons">create</i> Product Specifications</a>
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
            <div class="card mb-2">
                <div class="card-header form-wizard-step border-right border-top border-top-right-radius-0">
                    <h5>
                        <a class="btn btn-link" href="javascript:void(0)"><span>03</span><i class="material-icons">label_outline</i> Stock Information</a>
                    </h5>
                </div>
                <div class="card-body p-4 border border-top-0">
                    <div class="form-row">
                        <div class="col-lg-12">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="quantity">Product Quantity</label>
                                    <input type="text" class="form-control" id="quantity" v-model="quantity">
                                    <div class="invalid-feedback" id="quantity_feedback"></div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="description">Stock Note</label>
                                    <textarea style="min-height: 87px;" id="note" class="form-control" v-model="note"></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="notifyBelowQuantity">Notify Below Quantity</label>
                                    <input type="text" class="form-control" id="notifyBelowQuantity" v-model="notifyBelowQuantity">
                                    <div class="invalid-feedback" id="notifyBelowQuantity_feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header form-wizard-step border-right border-top border-top-right-radius-0">
                    <h5>
                        <a class="btn btn-link" href="javascript:void(0)"><span>04</span><i class="material-icons">add_a_photo</i> Product Pictures</a>
                    </h5>
                </div>
                <div class="card-body p-4 border border-top-0">
                    <div class="form-row">
                        <div class="col-lg-12">
                            <div class="form-row">
                                <div class="form-group col-md-12 m-0">
                                    <div>
                                        <div class="card card-small">
                                            <div class="row no-gutters">
                                                <div class="file-manager-cards__dropzone w-100">
                                                    <div class="dropzone dz-clickable">
                                                        <div class="dz-default dz-message">
                                                            <label class="text-reagent-gray mb-0">
                                                                <i class="material-icons mr-1"></i> Add Product Images <input class="d-none" type="file" accept="image/*" @change="handleImages">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-wizard-buttons text-md-right">
                <button type="button" class="btn btn-lg btn-pill btn-outline-primary" :class="{disabled: loading}" @click="validate">
                    <i class="material-icons">check</i> Save Product
                </button>
                <button class="btn btn-link p-0" v-show="loading"><div class="loader loader-sm"></div></button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "NewProduct",
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
                price: '',
                status: 1,
                quantity: '',
                note: '',
                notifyBelowQuantity: '',
                loaded: false,
                loading: false,
                error: false,
                images: [],
                attributes: [{name: '', value: ''}]
            }
        },
        methods: {
            loadShopCategoriesAndBrands() {
                this.loaded = false;
                axios.post(graphql.api, {
                    query: graphql.shopCategoriesAndBrands,
                    variables: {id: this.shop.id, count: 50, page: 1}
                }).then(this.loadData).catch(function (error) {});
            },
            loadData(response) {
                this.loaded = true;
                this.subCategoriesCount = response.data.data.shop.subCategoriesCount;
                this.categories = response.data.data.shop.categories.data;
                this.brands = response.data.data.shop.brands.data;
            },
            createProduct() {
                this.loading = true;
                axios.post(graphql.api, {
                    query: graphql.createProduct,
                    variables: {
                        product: {
                            brandId: this.brandId,
                            categoryId: this.subCategoryId,
                            price: this.price,
                            description: this.description,
                            name: this.name,
                            active: !!this.status,
                            stock: {quantity: this.quantity, note: this.note, type: 'STOCK_IN'},
                            minimum_stock: this.notifyBelowQuantity,
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

                if (!this.quantity.length > 0)
                    this.showError('quantity', "Product initial stock quantity is required");

                if (!this.notifyBelowQuantity.length > 0)
                    this.showError('notifyBelowQuantity', "Product minimum stock indicator is required");

                this.validateAttributes();

                if (!this.error) {
                    this.createProduct();
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
                this.price = '';
                this.categoryId = "";
                this.brandId = "";
                this.subCategoryId = "";
                this.notifyBelowQuantity = "";
                this.quantity = "";
                this.note = "";
                this.attributes = [{name: '', value: ''}];
                DToast("success", "Product created successfully")
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
            },
            handleImages(e) {

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
                    var category = Collect(this.categories).first(function (value, key) {
                        return value.id === data;
                    });
                    this.subCategories = category.categories.data;
                }
            },
            subCategoryId(data) {
                if (data) {
                    this.clearError('subCategory');
                }
            },
            quantity(data) {
                if (data) {
                    this.clearError('quantity');
                }
            },
            notifyBelowQuantity(data) {
                if (data) {
                    this.clearError('notifyBelowQuantity');
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
            },
            infoText() {
                return _.replace(this.addUrl, "-", "");
            },
            infoTextUpper() {
                return _.upperFirst(this.infoText);
            },
            addUrl() {
                if (!this.hasCategories) {
                    return 'categories';
                }

                if (!this.hasSubCategories) {
                    return 'sub-categories';
                }

                if (!this.hasBrands) {
                    return 'brands';
                }

                return '';
            }
        },
        props: {
            inventoryUrl: {
                type: String,
                required: true
            },
            shop: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>
    div#attributes .form-row:last-child .form-group {
        margin-bottom: 0 !important;
    }
</style>