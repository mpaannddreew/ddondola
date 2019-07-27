<template>
    <div class="directory-list close-directory-list">
        <div class="card card-small h-100 border-left border-right main">
            <div class="card-header border-bottom border-top-radius-0 bg-light">
                <div class="input-group input-group-seamless">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <input class="form-control" type="text" :placeholder="placeholder" aria-label="Search" v-model="query">
                </div>
            </div>
            <div class="card-body h-100">
                <div class="center-xy" v-if="!loaded && !showCategories || !showCategories && loaded">
                    <div align="center" v-if="!loaded && !showCategories">
                        <div class="loader"></div>
                        <p>loading categories...</p>
                    </div>
                    <div align="center" v-else-if="!showCategories && loaded">
                        <h4 class="m-0"><i class="material-icons">error</i></h4>
                        <p class="m-0">No categories.</p>
                    </div>
                </div>
                <ul class="list-group" v-if="loaded && showCategories">
                    <li class="list-group-item" v-for="(category, indx) in categories" :key="indx">
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" :id="'category-' + indx" v-model="categoryIds" :value="category.id">
                            <label class="custom-control-label" :for="'category-' + indx">{{ category.name }}</label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Categories",
        mounted() {
            this.fetchCategories();
        },
        data() {
            return {
                categories: [],
                page: 1,
                loaded: false,
                paginatorInfo: null,
                categoryIds: [],
                query: ''
            }
        },
        props: {
           directory: {
               type: String,
               required: true
           }
        },
        methods: {
            fetchCategories() {
                this.loaded = false;
                this.categories = [];
                this.categoryRequest().then(this.loadCategories).catch(function (error) {});
            },
            categoryRequest() {
                return axios.post(graphql.api, {
                    query: graphql.categories,
                    variables: {count: graphql.rowCount, page: this.page}
                });
            },
            loadCategories(categories) {
                this.loaded = true;
                this.categories = categories.data.data.categories.data;
                this.paginatorInfo = categories.data.data.categories.paginatorInfo;
            }
        },
        computed: {
            showCategories() {
                return this.categories.length > 0;
            },
            placeholder() {
                return `Filter ${_.upperFirst(this.directory)}`;
            }
        },
        watch: {
            categoryIds(data) {
                Bus.$emit('category-ids', data);
            },
            query(data) {
                Bus.$emit('directory-filter', data);
            }
        }
    }
</script>

<style scoped>

</style>