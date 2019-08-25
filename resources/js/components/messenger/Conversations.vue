<template>
    <div class="contacts h-100">
        <div class="center-xy" v-if="!loaded || (!hasConversations && loaded)">
            <div align="center" v-if="!loaded">
                <div class="loader"></div>
                <p>loading conversations...</p>
            </div>
            <div align="center" v-else-if="!hasConversations && loaded">
                <h4 class="m-0"><i class="material-icons">error</i></h4>
                <p class="m-0">No conversations.</p>
            </div>
        </div>
        <ul class="contact-list" v-else-if="hasConversations && loaded">
            <li is="conversation" v-for="(conversation, indx) in conversations" :key="indx" :home-url="homeUrl" :conversation="conversation" :owner-id="ownerId" :owner-type="ownerType"></li>
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
                count: 0
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
            variables() {
                var variables = {count: this.count, page: 1};
                if (this.ownerType === 'shop') {
                    variables["id"] = this.ownerId;
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
                Bus.$on('filter', this.filter)
            },
            filter(filter) {
                DToast("success", filter + " conversations");
            },
            fetchConversations() {
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
                this.fetchConversations();
            }
        }
    }
</script>

<style scoped>

</style>