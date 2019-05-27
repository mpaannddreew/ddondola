<template>
    <div class="directory-list close-directory-list">
        <div class="card card-small h-100 border-left border-right">
            <div class="card-header border-bottom border-top-radius-0 bg-light">
                <div class="input-group input-group-seamless">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <input class="form-control" type="text" placeholder="Filter Categories" aria-label="Search">
                </div>
            </div>
            <div class="card-body h-100">
                <template v-if="!loaded && !showCategories">
                    <div align="center" class="p-4">
                        <div class="loader"></div>
                        <p>loading categories...</p>
                    </div>
                </template>
                <template v-else-if="!showCategories && loaded">
                    <div align="center" class="p-4">
                        <h4 class="m-0"><i class="material-icons">error</i></h4>
                        <p class="m-0">No categories.</p>
                    </div>
                </template>
                <div class="list-group" v-if="loaded && showCategories">
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action d-flex" @click="transitionHome" :class="{selected: showingAll}">
                        <span class="category-name text-ellipsis"><i class="material-icons">library_books</i> All {{ directory|ucFirst }}</span>
                        <i class="material-icons ml-auto text-right view-report">chevron_right</i>
                    </a>
                    <category :directory="directory" v-for="(category, indx) in categories" :category="category" :key="indx"></category>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Category from "./Category";
    export default {
        name: "Categories",
        components: {Category},
        mounted() {
            this.fetchCategories();
        },
        data() {
            return {
                categories: [],
                page: 1,
                loaded: false,
                paginatorInfo: null,
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
            },
            transitionHome() {
                this.$router.push("/" + this.directory);
            }
        },
        computed: {
            showCategories() {
                return this.categories.length > 0;
            },
            showingAll() {
                return typeof this.$route.params.category === 'undefined';
            }
        },
        filters: {
            ucFirst(data) {
                return _.upperFirst(data);
            }
        }
    }
</script>

<style scoped>
    span {
        display: block;
    }

    span.category-name {
        font-weight: 300;
        font-size: 1rem;
    }

    span.category-description {
        font-size: .625rem;
        color: #818ea3;
    }
</style>