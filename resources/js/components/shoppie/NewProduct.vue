<template>
    <div class="card card-small border">
        <div class="card-body">
            <div align="center" v-if="!loaded"><div class="loader"></div></div>
            <div v-else-if="loaded && requirementsLoaded">
                <div class="form-row">
                    <div class="col mb-3">
                        <h6 class="form-text m-0">General</h6>
                        <p class="form-text text-muted m-0">Setup product general details.</p>
                    </div>
                </div>
                <div class="form-row mx-4">
                    <div class="col-lg-12">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" id="name" v-model="name">
                                <div class="invalid-feedback" id="name_feedback"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="category">Product Category</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><a :href="inventoryUrl + '/categories'" title="Add Category" data-toggle="tooltip"><i class="material-icons">add_circle</i></a></span>
                                    </div>
                                    <select id="category" class="form-control form-control-sm custom-select custom-select-sm" tabindex="-1" aria-hidden="true" v-model="categoryId">
                                        <option v-for="(category, indx) in categories" :value="category.id" :key="indx">{{ category.name }}</option>
                                    </select>
                                </div>
                                <div class="invalid-feedback" id="category_feedback"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subCategory">Product Sub Category</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><a :href="inventoryUrl + '/sub-categories'" title="Add Sub Category" data-toggle="tooltip"><i class="material-icons">add_circle</i></a></span>
                                    </div>
                                    <select id="subCategory" class="form-control form-control-sm custom-select custom-select-sm" tabindex="-1" aria-hidden="true" v-model="subCategoryId">
                                        <option v-for="(category, indx) in subCategories" :value="category.id" :key="indx">{{ category.name }}</option>
                                    </select>
                                </div>
                                <div class="invalid-feedback" id="subCategory_feedback"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="brand">Product Brand</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><a :href="inventoryUrl + '/brands'" title="Add Brand" data-toggle="tooltip"><i class="material-icons">add_circle</i></a></span>
                                    </div>
                                    <select id="brand" class="form-control form-control-sm custom-select custom-select-sm" tabindex="-1" aria-hidden="true" v-model="brandId">
                                        <option v-for="(brand, indx) in brands" :value="brand.id" :key="indx">{{ brand.name }}</option>
                                    </select>
                                </div>
                                <div class="invalid-feedback" id="brand_feedback"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="description">Product Description</label>
                                <textarea style="min-height: 87px;" id="description" class="form-control" v-model="description"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Product Status</label>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" name="status" id="product_active" value="1" checked="" v-model="status">
                                    <label class="custom-control-label" for="product_active">
                                        Active
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" name="status" id="product_inactive" value="0" v-model="status">
                                    <label class="custom-control-label" for="product_inactive">
                                        Inactive
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col mb-3">
                        <h6 class="form-text m-0">Pricing</h6>
                        <p class="form-text text-muted m-0">Setup product pricing details.</p>
                    </div>
                </div>
                <div class="form-row mx-4">
                    <div class="col-lg-12">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="price">General Price</label>
                                <input type="text" class="form-control" id="price" v-model="price">
                                <div class="invalid-feedback" id="price_feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col mb-3">
                        <h6 class="form-text m-0">Stock</h6>
                        <p class="form-text text-muted m-0">Setup product initial stock details.</p>
                    </div>
                </div>
                <div class="form-row mx-4">
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
                <div class="form-row">
                    <div class="col mb-3">
                        <h6 class="form-text m-0">Product Pictures</h6>
                        <p class="form-text text-muted m-0">Add product pictures.</p>
                    </div>
                </div>
                <div class="form-row mx-4">
                    <div class="col-lg-12">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Product Images</label>
                                <div>
                                    <div class="card card-small">
                                        <div class="row no-gutters">
                                            <div class="file-manager-cards__dropzone w-100">
                                                <div class="dropzone dz-clickable">
                                                    <div class="dz-default dz-message">
                                                        <label class="text-reagent-gray">
                                                            <i class="material-icons mr-1"></i> Add Product Images <input class="d-none" type="file" multiple accept="image/*" @change="handleImages">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Max. file size: 50 MB. Allowed images: jpg, gif, png. Maximum 10 images only.</small>
                                </div>
                                <div class="row images">
                                    <!--<div class="col-md-3 col-sm-3 col-4 col-lg-3 col-xl-2">-->
                                        <!--<div class="product-thumbnail">-->
                                            <!--<img src="/images/avatars/0.jpg" class="img-thumbnail img-fluid" alt="">-->
                                            <!--<span class="product-remove" title="remove"><i class="fa fa-close"></i></span>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-3 col-sm-3 col-4 col-lg-3 col-xl-2">-->
                                        <!--<div class="product-thumbnail">-->
                                            <!--<img src="/images/avatars/0.jpg" class="img-thumbnail img-fluid" alt="">-->
                                            <!--<span class="product-remove" title="remove"><i class="fa fa-close"></i></span>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-3 col-sm-3 col-4 col-lg-3 col-xl-2">-->
                                        <!--<div class="product-thumbnail">-->
                                            <!--<img src="/images/avatars/0.jpg" class="img-thumbnail img-fluid" alt="">-->
                                            <!--<span class="product-remove" title="remove"><i class="fa fa-close"></i></span>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-3 col-sm-3 col-4 col-lg-3 col-xl-2">-->
                                        <!--<div class="product-thumbnail">-->
                                            <!--<img src="/images/avatars/0.jpg" class="img-thumbnail img-fluid" alt="">-->
                                            <!--<span class="product-remove" title="remove"><i class="fa fa-close"></i></span>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-3 col-sm-3 col-4 col-lg-3 col-xl-2">-->
                                        <!--<div class="product-thumbnail">-->
                                            <!--<img src="/images/avatars/0.jpg" class="img-thumbnail img-fluid" alt="">-->
                                            <!--<span class="product-remove" title="remove"><i class="fa fa-close"></i></span>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-3 col-sm-3 col-4 col-lg-3 col-xl-2">-->
                                        <!--<div class="product-thumbnail">-->
                                            <!--<img src="/images/avatars/0.jpg" class="img-thumbnail img-fluid" alt="">-->
                                            <!--<span class="product-remove" title="remove"><i class="fa fa-close"></i></span>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-4">
                    <button type="button" class="btn btn-success btn-md" :class="{disabled: loading}" @click="validate">
                        <i class="fa fa-check-circle"></i> Save Product
                    </button>
                    <button class="btn btn-link p-0" v-show="loading"><div class="loader loader-sm"></div></button>
                </div>
            </div>
            <div align="center" v-else-if="loaded && !requirementsLoaded">
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
                images: []
            }
        },
        methods: {
            loadShopCategoriesAndBrands() {
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
                            minimum_stock: this.notifyBelowQuantity
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

                if (!this.quantity.length > 0)
                    this.showError('quantity', "Product initial stock quantity is required");

                if (!this.notifyBelowQuantity.length > 0)
                    this.showError('notifyBelowQuantity', "Product minimum stock indicator is required");

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
                console.log(JSON.stringify(response));
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
                DToast("success", "Product created successfully")
                // $('.row .images .col-md-3.col-sm-3.col-4.col-lg-3.col-xl-2').remove();
            },
            handleImages(e) {
                // $('.row .images .col-md-3.col-sm-3.col-4.col-lg-3.col-xl-2').remove();
                // var files = !!e.target.files ? e.target.files : [];
                // if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
                //
                // for(var i = 0; i < files.length; i++){
                //
                //     if (/^image/.test( files[i].type)){ // only image file
                //         var reader = new FileReader(); // instance of the FileReader
                //         reader.readAsDataURL(files[i]); // read the local file
                //
                //         reader.onload = function (event) {
                //             var $div_column = $('<div/>').addClass('col-md-3 col-sm-3 col-4 col-lg-3 col-xl-2');
                //             var $div_thumbnail = $('<div/>').addClass('product-thumbnail');
                //             var $img = $('<img/>').addClass('img-thumbnail img-fluid');
                //             var $span = $('<span/>').addClass('product-remove').attr('id', i);
                //
                //             $span.bind('click', function () {
                //                 // var _id = $('span#' + i).id;
                //                 // files[parseInt(_id)].delete();
                //                 $div_column.remove();
                //             });
                //
                //             var $i = $('<i/>').addClass('fa fa-close');
                //
                //             $img.attr('src', event.target.result);
                //             $span.append($i);
                //             $div_thumbnail.append($img);
                //             $div_thumbnail.append($span);
                //             $div_column.append($div_thumbnail);
                //
                //             $('.row .images').append($div_column);
                //         };
                //     }
                // }
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
            }
        },
        computed: {
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

</style>