<template>
    <div class="checkout-process">
        <div class="card mb-4">
            <div class="card-header form-wizard-step border-right border-top border-top-right-radius-0">
                <h5>
                    <a class="btn btn-link" href="javascript:void(0)">
                        <span>01</span><i class="material-icons">info</i> General Information
                    </a>
                </h5>
            </div>
            <div class="card-body p-4 border border-top-0">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">Product Name</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Product Category</label>
                        <select class="form-control form-control-md custom-select custom-select-md" tabindex="-1" aria-hidden="true">
                            <option>Select</option>
                            <option>Electronics</option>
                            <option>Fashion</option>
                            <option>Books</option>
                            <option>Toys</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Product Sub Category</label>
                        <select class="form-control form-control-md custom-select custom-select-md" tabindex="-1" aria-hidden="true">
                            <option>Select</option>
                            <option>Televisions</option>
                            <option>Headphones</option>
                            <option>Clothing</option>
                            <option>Shoes</option>
                            <option>Toys &amp; Games</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Product Brand</label>
                        <select class="form-control form-control-md custom-select custom-select-md" tabindex="-1" aria-hidden="true">
                            <option>Select</option>
                            <option>Televisions</option>
                            <option>Headphones</option>
                            <option>Clothing</option>
                            <option>Shoes</option>
                            <option>Toys &amp; Games</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="price">General Price</label>
                        <input type="text" class="form-control" id="price">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">Product Description</label>
                        <textarea style="min-height: 87px;" id="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Product Status</label>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" name="status" id="product_active" value="option1" checked="">
                            <label class="custom-control-label" for="product_active">
                                Active
                            </label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" name="status" id="product_inactive" value="option2">
                            <label class="custom-control-label" for="product_inactive">
                                Inactive
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-wizard-buttons text-md-right">
            <button type="button" class="btn btn-lg btn-pill btn-outline-primary">
                <i class="material-icons">check</i> Update Product
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EditProduct"
    }
</script>

<style scoped>

</style>