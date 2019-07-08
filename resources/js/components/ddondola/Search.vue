<template>
    <form id="search-wrapper" action="#" class="w-100" :class="classObject">
        <div class="input-group input-group-seamless">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <div align="center" v-if="searching"><div class="loader"></div></div>
                    <i class="material-icons text-white" v-else>search</i>
                </div>
            </div>
            <input style="padding-left: 1.875rem;" class="navbar-search form-control" id="search" type="text" placeholder="What are you looking for?" aria-label="Search">
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
            return {
                searching: false,
                limit: 10
            }
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
                        limit: this.limit,
                        templates: {
                            header: '<div class="card border-bottom">\n' +
                            '            <article class="card-group-item">\n' +
                            '                <header class="card-header py-2" style="border-radius: 0;"><h6 class="title">Products</h6></header>\n' +
                            '            </article> <!-- card-group-item.// -->\n' +
                            '        </div>',
                            suggestion: function(data) {
                                return '<div>\n' +
                                    '      <a href="/products/' + data.code + '">' +
                                    '        <div class="row py-2 px-4 border-bottom">\n' +
                                    '            <div class="user-teams__image col-2 col-sm-1 col-lg-2 p-0 my-auto">\n' +
                                    '                <img class="rounded" src="' + data.images[0].url + '">\n' +
                                    '            </div>\n' +
                                    '            <div class="col pl-3">\n' +
                                    '                <h6 class="m-0">' + data.name + '</h6>\n' +
                                    '                <span class="text-light">' + data.reviewCount + ' Review(s) | UGX ' + data.discountedPrice + '</span>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '      </a>' +
                                    '    </div>';
                            }
                        }
                    },
                    {
                        name: 'shops',
                        source: this.shopSource(),
                        display: function(item) {
                            return item.name;
                        },
                        limit: this.limit,
                        templates: {
                            header: '<div class="card border-bottom">\n' +
                            '           <article class="card-group-item">\n' +
                            '              <header class="card-header py-2" style="border-radius: 0;"><h6 class="title">Shops</h6></header>\n' +
                            '           </article> <!-- card-group-item.// -->\n' +
                            '       </div>',
                            suggestion: function(data) {
                                return '<div>\n' +
                                    '      <a href="/shops/' + data.code + '">' +
                                    '        <div class="row py-2 px-4 border-bottom">\n' +
                                    '            <div class="user-teams__image col-2 col-sm-1 col-lg-2 p-0 my-auto">\n' +
                                    '                <img class="rounded" src="' + data.avatar.url + '">\n' +
                                    '            </div>\n' +
                                    '            <div class="col pl-3">\n' +
                                    '                <h6 class="m-0">' + data.name + '</h6>\n' +
                                    '                <span class="text-light">' + data.category.name + ' | ' + data.reviewCount + ' Review(s) | ' + data.likes + ' Like(s)</span>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </div>';
                            }
                        }
                    },
                    {
                        name: 'users',
                        source: this.userSource(),
                        display: function(item) {
                            return item.name;
                        },
                        limit: this.limit,
                        templates: {
                            header: '<div class="card border-bottom">\n' +
                            '            <article class="card-group-item">\n' +
                            '                <header class="card-header py-2" style="border-radius: 0;"><h6 class="title">People</h6></header>\n' +
                            '            </article> <!-- card-group-item.// -->\n' +
                            '        </div>',
                            suggestion: function(data) {
                                return '<div>\n' +
                                    '     <a href="/people/' + data.code + '">' +
                                    '        <div class="row py-2 px-4 border-bottom">\n' +
                                    '            <div class="user-teams__image col-2 col-sm-1 col-lg-2 p-0 my-auto">\n' +
                                    '                <img class="rounded" src=" ' + data.avatar.url + ' ">\n' +
                                    '            </div>\n' +
                                    '            <div class="col pl-3">\n' +
                                    '                <h6 class="m-0">' + data.name + '</h6>\n' +
                                    '                <span class="text-light">' + data.followerCount + ' Follower(s) | ' + data.followingCount + ' Following</span>\n' +
                                    '            </div>\n' +
                                    '        </div>\n' +
                                    '    </a>' +
                                    '  </div>';
                            }
                        }
                    })
                    .on('typeahead:asyncrequest', this.showSpinner)
                    .on('typeahead:asynccancel typeahead:asyncreceive', this.hideSpinner);
            },
            showSpinner() {
                this.searching = true;
            },
            hideSpinner() {
                this.searching = false;
            },
            transform(data) {
                if (data.data.products) {
                    return data.data.products;
                }

                if (data.data.shops) {
                    return data.data.shops;
                }

                if (data.data.users) {
                    return data.data.users;
                }

                return [];
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