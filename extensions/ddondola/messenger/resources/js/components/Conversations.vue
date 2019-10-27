<template>
    <div class="contacts h-100">
        <div class="center-xy" v-if="!loaded || (!hasConversations && loaded)">
            <div align="center" v-if="!loaded">
                <div class="loader"></div>
                <p>loading conversations...</p>
            </div>
            <div align="center" v-else-if="!hasConversations && loaded">
                <h4 class="m-0"><i class="material-icons">error</i></h4>
                <p class="m-0">You have no conversations!</p>
            </div>
        </div>
        <ul class="contact-list" v-else-if="hasConversations && loaded">
            <li is="conversation" v-for="(conversation, indx) in conversations" :key="indx" :home-url="homeUrl"
                :conversation="conversation" :owner-id="ownerId" :owner-type="ownerType"
                v-on:update-conversation="updateConversation"></li>
        </ul>
    </div>
</template>

<script>
    import Conversation from "./Conversation";
    export default {
        name: "Conversations",
        components: {Conversation},
        mounted() {
            this.listen();
            this.loadMore(false);
        },
        data() {
            return {
                conversations: [],
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
            hasConversations() {
                return this.conversations.length > 0;
            },
            converser() {
                return {id: this.ownerId, type: this.ownerType};
            },
            variables() {
                var variables = {count: this.count, page: 1, converser: this.converser};
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
                    return graphql.shopConversations;
                }

                return graphql.myConversations;
            }
        },
        methods: {
            listen() {
                Bus.$on('filter', this.filter);
                // todo listen for new conversations
            },
            filter(filter) {
                this.searchFilter = filter;
            },
            fetchConversations(loaded=false) {
                if (!loaded) {
                    this.conversations = [];
                    this.loaded = loaded;
                }

                axios.post(graphql.api, {
                    query: this.query,
                    variables: this.variables
                }).then(this.loadConversations).catch(function (error) {});
            },
            loadConversations(response) {
                this.loaded = true;
                if (this.ownerType === 'shop') {
                    this.conversations = response.data.data.shop.conversations.data;
                    this.paginatorInfo = response.data.data.shop.conversations.paginatorInfo;
                }else {
                    this.conversations = response.data.data.me.conversations.data;
                    this.paginatorInfo = response.data.data.me.conversations.paginatorInfo;
                }
            },
            loadMore(indicator=true) {
                this.loadingMore = indicator;
                this.count += graphql.rowCount;
                this.fetchConversations(indicator);
            },
            updateConversation(conversation) {
                // todo re order conversations
            }
        },
        watch: {
            searchFilter: _.debounce(function (data) {
                this.count = graphql.rowCount;
                this.fetchConversations();
            }, 1000)
        }
    }
</script>

<style scoped>

</style>