<template>
    <div class="card card-small h-100 border-right main" style="border-radius: 0; box-shadow: none;">
        <div class="card-header border-bottom bg-light" style="padding: 0.43rem;">
            <div class="row bg-light m-0">
                <div class="col-12 col-sm-2 mb-sm-0 p-0">
                    <a href="javascript:void(0)" class="btn btn-sm btn-link mr-auto ml-auto mr-sm-auto ml-sm-0 mt-3 mt-sm-0" @click="showOwnRepository">
                        <i class="material-icons" style="font-size: large;">arrow_back</i>
                    </a>
                </div>
                <div class="col-12 p-0 col-sm-10">
                    <div class="input-group input-group-seamless">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <div align="center" v-if="searching"><div class="loader"></div></div>
                                <i class="material-icons" v-else>search</i>
                            </div>
                        </div>
                        <input v-model="query" id="contact_search" class="form-control" type="text" placeholder="Search Ddondola" style="margin: 0; padding-left: 1.875rem;">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body d-flex flex-column">
            <div class="contacts h-100" id="contacts">
                <div v-if="hasShops">
                    <div class="card border-bottom" style="height: auto !important;">
                        <article class="card-group-item">
                            <header class="card-header py-2" style="border-radius: 0;"><h6 class="title">Shops</h6></header>
                        </article>
                    </div>
                    <ul class="contact-list">
                        <li is="contact" v-for="(contact, indx) in shops" :key="indx" :home-url="homeUrl" :contact="contact"></li>
                    </ul>
                </div>
                <div v-if="hasUsers">
                    <div class="card border-bottom" style="height: auto !important;">
                        <article class="card-group-item">
                            <header class="card-header py-2" style="border-radius: 0;"><h6 class="title">People</h6></header>
                        </article>
                    </div>
                    <ul class="contact-list">
                        <li is="contact" v-for="(contact, indx) in users" :key="indx" :home-url="homeUrl" :contact="contact"></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Contact from "./Contact";
    export default {
        name: "AllContacts",
        components: {Contact},
        mounted() {
            this.initSearch();
        },
        data() {
            return {
                searching: false,
                shops: [],
                users: [],
                query: ''
            }
        },
        props: {
            homeUrl: {
                type: String,
                require: true
            },
            ownerId: {
                required: true
            },
            ownerType: {
                type: String,
                required: true
            }
        },
        computed: {
            hasShops() {
                return this.shops.length > 0;
            },
            hasUsers() {
                return this.users.length > 0;
            }
        },
        methods: {
            shopsData() {
                return {
                    name: 'shops',
                    source: this.shopSource()
                };
            },
            usersData() {
                return {
                    name: 'users',
                    source: this.userSource()
                };
            },
            searchOptions() {
                return {
                    hint: true,
                    highlight: true,
                    minLength: 1,
                    classNames: {
                        wrapper: "w-100",
                        input: "form-control",
                        hint: "form-control",
                        menu: "hide",
                    }
                };
            },
            showOwnRepository() {
                Bus.$emit('show-own-repository');
            },
            search() {
                var search = $('#contact_search');
                if (this.lowerCase(this.ownerType.toString()) === 'user') {
                    return search.typeahead(this.searchOptions(), this.shopsData(), this.usersData());
                }

                return search.typeahead(this.searchOptions(), this.usersData());
            },
            initSearch() {
                this.search().on('typeahead:asyncrequest', this.showSpinner)
                    .on('typeahead:asynccancel typeahead:asyncreceive', this.hideSpinner);
            },
            showSpinner() {
                this.shops = [];
                this.users = [];
                this.searching = true;
            },
            hideSpinner() {
                this.searching = false;
            },
            transform(data) {
                if (data.data.shops) {
                    this.shops = this.rejectSelf(data.data.shops, 'shop');
                }

                if (data.data.users) {
                    this.users = this.rejectSelf(data.data.users, 'user');
                }

                return [];
            },
            rejectSelf(data, type) {
                if (this.lowerCase(this.ownerType.toString()) === type.toString()) {
                    return Collect(data).reject(this.reject).all();
                }

                return data;
            },
            reject(contact) {
                return (contact.id).toString() === (this.ownerId).toString();
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
        },
        watch: {
            query: _.debounce(function (data) {
                if (data.length === 0) {
                    this.shops = [];
                    this.users = [];
                }
            }, 100)
        }
    }
</script>

<style scoped>
    div.loader {
        width: 15px;
        height: 15px;
    }
</style>