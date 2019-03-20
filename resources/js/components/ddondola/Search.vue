<template>
    <form id="search-wrapper" action="#" class="w-100" :class="classObject">
        <div class="input-group input-group-seamless">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <!--<div align="center"><div class="loader"></div></div>-->
                    <i class="material-icons">search</i>
                </div>
            </div>
            <input style="padding-left: 1.875rem;" class="navbar-search form-control" id="search" type="text" placeholder="Search" aria-label="Search">
        </div>
    </form>
</template>

<script>
    export default {
        name: "Search",
        mounted() {
            this.initSearch();
        },
        data() {
            return {}
        },
        props: {
            sideSearch: {
                type: Boolean,
                default: false
            }
        },
        computed: {
            classObject() {
                return {
                    'main-sidebar__search': this.sideSearch,
                    'border-right': this.sideSearch,
                    'd-sm-flex': this.sideSearch,
                    'd-md-none': this.sideSearch,
                    'd-lg-none': this.sideSearch,
                    'main-navbar__search': !this.sideSearch,
                    'd-none': !this.sideSearch,
                    'd-md-flex': !this.sideSearch,
                    'd-lg-flex': !this.sideSearch,
                }
            }
        },
        methods: {
            initSearch() {
                $('#search').typeahead({
                        hint: true,
                        highlight: true,
                        minLength: 1,
                        classNames: {
                            wrapper: "dropdown w-100 navbar-search form-control border-0 p-0",
                            input: "navbar-search form-control h-100",
                            hint: "navbar-search form-control h-100",
                            menu: "dropdown-menu dropdown-menu-small w-100 border-top-radius-0 p-0 scrollable",
                            // dataset: "",
                            // suggestion: "",
                            // selectable: "",
                            // empty: "",
                            open: "show",
                            // cursor: "",
                            // highlight: ""
                        }
                    },
                    {
                        name: 'products',
                        source: this.productSource(),
                        display: function(item) {
                            return item.name;
                        },
                        templates: {
                            header: '<div class="card">\n' +
                            '\t<article class="card-group-item">\n' +
                            '\t\t<header class="card-header py-2" style="border-radius: 0;"><h6 class="title">Products</h6></header>\n' +
                            '\t</article> <!-- card-group-item.// -->\n' +
                            '</div>',
                            suggestion: function(data) {
                                return '\n' +
                                    '<figure class="itemside m-2">\n' +
                                    '\t<div class="aside">\n' +
                                    '\t\t<div class="img-wrap img-sm" style="max-width: 3rem; max-height: 3rem;">' +
                                    '<img src="/images/avatars/0.jpg" class="img-thumbnail user-avatar" style="max-width: 3rem; max-height: 3rem;"></div>\n' +
                                    '\t</div>\n' +
                                    '\t<figcaption class="text-wrap">\n' +
                                    '\t\t<h6 class="title m-0"><a href="/products/' + data.code + '">' + data.name + '</a></h6>\n' +
                                    '\t\t<span class="text-muted">' + data.category.name +' | ' + data.subcategory.name + ' | ' + data.brand.name + ' | 40 Reviews | UGX ' + data.price + '</span>\n' +
                                    '\t</figcaption>\n' +
                                    '</figure> \n';
                            }
                        }
                    },
                    {
                        name: 'shops',
                        source: this.shopSource(),
                        display: function(item) {
                            return item.name;
                        },
                        templates: {
                            header: '<div class="card">\n' +
                            '\t<article class="card-group-item">\n' +
                            '\t\t<header class="card-header py-2" style="border-radius: 0;"><h6 class="title">Shops</h6></header>\n' +
                            '\t</article> <!-- card-group-item.// -->\n' +
                            '</div>',
                            suggestion: function(data) {
                                return '\n' +
                                    '<figure class="itemside m-2">\n' +
                                    '\t<div class="aside">\n' +
                                    '\t\t<div class="img-wrap img-sm" style="max-width: 3rem; max-height: 3rem;">' +
                                    '<img src="/images/avatars/0.jpg" class="img-thumbnail user-avatar" style="max-width: 3rem; max-height: 3rem;"></div>\n' +
                                    '\t</div>\n' +
                                    '\t<figcaption class="text-wrap">\n' +
                                    '\t\t<h6 class="title m-0"><a href="/shops/' + data.code + '">' + data.name + '</a></h6>\n' +
                                    '\t\t<span class="text-muted">' + data.category.name + ' | 128 Reviews | 3k Likes</span>\n' +
                                    '\t</figcaption>\n' +
                                    '</figure> \n';
                            }
                        }
                    },
                    {
                        name: 'users',
                        source: this.userSource(),
                        display: function(item) {
                            return item.name;
                        },
                        templates: {
                            header: '<div class="card">\n' +
                            '\t<article class="card-group-item">\n' +
                            '\t\t<header class="card-header py-2" style="border-radius: 0;"><h6 class="title">People</h6></header>\n' +
                            '\t</article> <!-- card-group-item.// -->\n' +
                            '</div>',
                            suggestion: function(data) {
                                return '\n' +
                                    '<figure class="itemside m-2">\n' +
                                    '\t<div class="aside">\n' +
                                    '\t\t<div class="img-wrap img-sm" style="max-width: 3rem; max-height: 3rem;">' +
                                    '<img src="/images/avatars/0.jpg" class="img-thumbnail user-avatar" style="max-width: 3rem; max-height: 3rem;"></div>\n' +
                                    '\t</div>\n' +
                                    '\t<figcaption class="text-wrap">\n' +
                                    '\t\t<h6 class="title m-0"><a href="/people/' + data.code + '">' + data.name + '</a></h6>\n' +
                                    '\t\t<span class="text-muted">148 Followers | 390 Following</span>\n' +
                                    '\t</figcaption>\n' +
                                    '</figure> \n';
                            }
                        }
                    });
            },
            transform(data) {
                return data.data.results;
            },
            productSource() {
                return new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                        url: graphql.api,
                        prepare: function(query, settings) {
                            settings.url = settings.url + "?" + $.param({query: graphql.searchProducts, variables: {name: query}});
                            settings.headers = SearchHeaders;
                            settings.type = "GET";
                            return settings;
                        },
                        transform: this.transform
                    },
                });
            },
            shopSource() {
                return new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                        url: graphql.api,
                        prepare: function(query, settings) {
                            settings.url = settings.url + "?" + $.param({query: graphql.searchShops, variables: {name: query}});
                            settings.headers = SearchHeaders;
                            settings.type = "GET";
                            return settings;
                        },
                        transform: this.transform
                    },
                });
            },
            userSource() {
                return new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                        url: graphql.api,
                        prepare: function(query, settings) {
                            settings.url = settings.url + "?" + $.param({query: graphql.searchUsers, variables: {name: query}});
                            settings.headers = SearchHeaders;
                            settings.type = "GET";
                            return settings;
                        },
                        transform: this.transform
                    },
                });
            }
        }
    }
</script>

<style scoped>
    i.material-icons {
        font-weight: bold;
    }

    div.loader {
        width: 15px;
        height: 15px;
    }
</style>