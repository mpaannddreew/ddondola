<template>
    <div class="h-100" style="overflow-x: hidden; overflow-y: auto;">
        <div class="center-xy" v-if="!loaded && !showCategories || !showCategories && loaded">
            <div align="center" v-if="!loaded && !showCategories">
                <div class="loader"></div>
                <p>loading categories...</p>
            </div>
            <div align="center" v-else-if="!showCategories && loaded">
                <h4 class="m-0"><i class="material-icons">error</i></h4>
                <p class="m-0">Categories not defined yet!</p>
            </div>
        </div>
        <div id="accordion" v-if="loaded && showCategories">
            <div class="panel list-group">
                <template v-for="(category, indx) in categories">
                    <a :href="`#category-${category.id}`" data-parent="#accordion" data-toggle="collapse" class="list-group-item">
                        <div class="d-flex">
                            <span class="category-name text-ellipsis">{{ category.name }} ({{ category.productCount }})</span>
                            <i class="material-icons ml-auto text-right view-report">add</i>
                        </div>
                    </a>
                    <div class="collapse" :id="`category-${category.id}`">
                        <ul class="list-group">
                            <li class="list-group-item px-4" v-for="(subCategory, _indx) in category.categories" :key="_indx">
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" class="custom-control-input" :name="`category-${category.id}-${_indx}`" :id="`category-${category.id}-${_indx}`" v-model="subCategoryIds" :value="subCategory.id">
                                    <label class="custom-control-label text-ellipsis" :for="`category-${category.id}-${_indx}`">{{ subCategory.name }} ({{ subCategory.productCount }})</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShopProductCategories",
        mounted() {
            this.fetchCategories();
        },
        data() {
            return {
                categories: [],
                page: 1,
                loaded: false,
                paginatorInfo: null,
                subCategoryIds: []
            }
        },
        props: {
            admin: {
                type: Boolean,
                default: false
            },
            shop: {
                type: String,
                required: true
            }
        },
        methods: {
            fetchCategories() {
                axios.post(graphql.api, {
                    query: graphql.shopCategoriesAndSubCategories,
                    variables: {shop: this.shop, count: graphql.rowCount, page: this.page}
                }).then(this.loadCategories).catch(function (error){});
            },
            loadCategories(response) {
                this.loaded = true;
                this.categories = response.data.data.shop.categories.data;
                this.paginatorInfo = response.data.data.shop.categories.paginatorInfo;
            }
        },
        computed: {
            showCategories() {
                return this.categories.length > 0;
            },
            categoriesHaveProducts() {
                return Collect(this.categories).reject(function(value, key) {
                    return value.productCount === 0;
                }).count() > 0;
            }
        },
        watch: {
            subCategoryIds(data) {
                Bus.$emit("sub-category-ids", data);
            }
        }
    }
</script>

<style scoped>
    .h-100 {
        height: calc(99.9vh - 13.7rem - 1px) !important;
    }
</style>