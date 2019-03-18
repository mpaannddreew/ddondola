<template>
    <div class="card card-small border">
        <div class="card-body">
            <div align="center" v-if="!requirementsLoaded"><div class="loader"></div></div>
            <div v-else-if="requirementsLoaded">
                <div class="form-row">
                    <div class="col mb-3">
                        <h6 class="form-text m-0">General</h6>
                        <p class="form-text text-muted m-0">Setup shop general profile details.</p>
                    </div>
                </div>
                <div class="form-row mx-4">
                    <div class="col-lg-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Shop Category</label>
                                <select class="form-control form-control-md custom-select custom-select-md" tabindex="-1" aria-hidden="true" v-model="shopCategory" id="shopCategory">
                                    <option v-for="(category, indx) in categories" :key="indx" :value="category.id">{{ category.name }}</option>
                                </select>
                                <div class="invalid-feedback" id="shopCategory_feedback"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control p-2" id="name" v-model="name">
                                <div class="invalid-feedback" id="name_feedback"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phoneNumber">Phone Number</label>
                                <div class="input-group input-group-seamless">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="material-icons"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="phoneNumber" v-model="phoneNumber">
                                </div>
                                <div class="invalid-feedback" id="phoneNumber_feedback"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emailAddress">Email</label>
                                <div class="input-group input-group-seamless">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="material-icons"></i>
                                        </div>
                                    </div>
                                    <input type="email" class="form-control" id="emailAddress" v-model="emailAddress">
                                </div>
                                <div class="invalid-feedback" id="emailAddress_feedback"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Description</label>
                                <textarea style="min-height: 87px;" id="description" name="description" class="form-control" v-model="description"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="address">Address</label>
                                <textarea style="min-height: 87px;" id="address" name="address" class="form-control" v-model="address"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-4" v-show="requirementsLoaded">
                    <button type="button" class="btn btn-success btn-md" :class="{disabled: loading}" @click="validate">
                        <i class="fa fa-check-circle"></i> Create Shop
                    </button>
                    <button class="btn btn-link p-0" v-show="loading"><div class="loader loader-sm"></div></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "NewShop",
        mounted() {
            this.fetchCategories();
        },
        data() {
            return {
                name: '',
                categories: [],
                phoneNumber: '',
                emailAddress: '',
                description: '',
                address: '',
                shopCategory: '',
                loading: false,
                error: false,
            }
        },
        methods: {
            createShop() {
                axios.post(graphql.api, {
                    query: graphql.createShop,
                    variables: {
                        shop: {
                            name: this.name,
                            email: this.emailAddress,
                            categoryId: this.shopCategory,
                            phone_number: this.phoneNumber,
                            description: this.description,
                            address: this.address
                        }
                    }
                }).then(this.clearForm).catch(function (error) {});
            },
            validate() {
                this.loading = true;
                if (!this.shopCategory.length > 0)
                    this.showError('shopCategory', "Choose a category");

                if (!this.name.length > 0)
                    this.showError('name', "Shop name is required");

                if (!this.phoneNumber.length > 0)
                    this.showError('phoneNumber', "Valid phone number is required");

                if (!this.emailAddress.length > 0)
                    this.showError('emailAddress', "Valid email address is required");

                if (!this.error) {
                    this.createShop();
                }
            },
            fetchCategories() {
                axios.post(graphql.api, {
                    query: graphql.categories
                }).then(this.loadCategories).catch(function (error) {});
            },
            loadCategories(response) {
                this.categories = response.data.data.categories;
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
                this.emailAddress = '';
                this.shopCategory = '';
                this.phoneNumber = '';
                this.description = '';
                this.address = '';
                this.loading = false;
                DToast("success", "Shop created successfully")
            }
        },
        computed: {
            requirementsLoaded() {
                return this.categories.length > 0;
            }
        },
        watch: {
            shopCategory: function (data) {
                if (data.length > 0) {
                    this.clearError("shopCategory");
                }
            },
            name: function (data) {
                if (data.length > 0) {
                    this.clearError("name");
                }
            },
            phoneNumber: function (data) {
                if (data.length > 0) {
                    this.clearError("phoneNumber");
                }
            },
            emailAddress: function (data) {
                if (data.length > 0) {
                    this.clearError("emailAddress");
                }
            }
        }
    }
</script>

<style scoped>

</style>