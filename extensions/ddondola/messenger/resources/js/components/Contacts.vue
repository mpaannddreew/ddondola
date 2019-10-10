<template>
    <div class="contacts h-100">
        <div class="center-xy" v-if="!loaded || !hasContacts && loaded">
            <div align="center" v-if="!loaded">
                <div class="loader"></div>
                <p>loading contacts...</p>
            </div>
            <div align="center" v-else-if="!hasContacts && loaded">
                <h4 class="m-0"><i class="material-icons">error</i></h4>
                <p class="m-0">You have no contacts!</p>
            </div>
        </div>
        <ul class="contact-list" v-else-if="hasContacts && loaded">
            <li is="contact" v-for="(contact, indx) in contacts" :key="indx" :home-url="homeUrl" :contact="contact"></li>
        </ul>
    </div>
</template>

<script>
    import Contact from "./Contact";
    export default {
        name: "Contacts",
        components: {Contact},
        mounted() {
            this.listen();
            this.loadMore(false);
        },
        data() {
            return {
                contacts: [],
                loaded: false,
                paginatorInfo: null,
                loadingMore: false,
                count: 0,
                searchFilter: ''
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
            hasContacts() {
                return this.contacts.length > 0;
            },
            variables() {
                var variables = {count: this.count, page: 1};
                if (this.ownerType === 'shop') {
                    variables["id"] = this.ownerId;
                }

                if (this.searchFilter) {
                    variables["search"] = this.searchFilter;
                }

                return variables;
            },
            query() {
                if (this.ownerType === 'shop') {
                    return graphql.shopContacts;
                }

                return graphql.myContacts;
            }
        },
        methods: {
            listen() {
                Bus.$on('filter', this.filter)
            },
            filter(filter) {
                this.searchFilter = filter;
            },
            fetchContacts(loaded=false) {
                if (!loaded) {
                    this.contacts = [];
                    this.loaded = loaded;
                }
                axios.post(graphql.api, {
                    query: this.query,
                    variables: this.variables
                }).then(this.loadContacts).catch(function (error) {});
            },
            loadContacts(response) {
                this.loaded = true;
                if (this.ownerType === 'shop') {
                    this.contacts = response.data.data.shop.contacts.data;
                    this.paginatorInfo = response.data.data.shop.contacts.paginatorInfo;
                }else {
                    this.contacts = response.data.data.me.contacts.data;
                    this.paginatorInfo = response.data.data.me.contacts.paginatorInfo;
                }
            },
            loadMore(indicator=true) {
                this.loadingMore = indicator;
                this.count += graphql.rowCount;
                this.fetchContacts(indicator);
            }
        },
        watch: {
            searchFilter: _.debounce(function (data) {
                this.count = graphql.rowCount;
                this.loadMore(false);
            }, 1000)
        }
    }
</script>

<style scoped>

</style>