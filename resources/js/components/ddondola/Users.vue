<template>
    <div>
        <template v-if="!loaded">
            <div align="center"><div class="loader"></div></div>
        </template>
        <template v-else-if="!hasUsers && loaded">
            <div align="center">
                <h4>
                    <i class="material-icons">error_outline</i>
                    <br />
                    <small>This directory is empty!</small>
                </h4>
            </div>
        </template>
        <div class="friend-list" v-else-if="hasUsers && loaded">
            <div class="row">
                <template v-for="(_user, indx) in users">
                    <div class="col-md-4 col-sm-4">
                        <div is="user-card" :user="_user" :key="indx" :url="url" :is-me="isMe(_user.id)"></div>
                    </div>
                </template>
            </div>
        </div>
        <pagination v-if="paginatorInfo" class="my-4" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
    </div>
</template>

<script>
    export default {
        name: "Users",
        mounted() {
            this.fetchUsers();
        },
        data() {
            return {
                users: [],
                page: 1,
                count: 12,
                loaded: false,
                paginatorInfo: null
            }
        },
        props: {
            type: {
                type: String,
                required: true
            },
            user: {
                type: Object,
                required: false
            },
            me: {
                type: Object,
                required: false
            },
            url: {
                type: String,
                required: true
            }
        },
        computed: {
            hasUsers() {
                return this.users.length > 0;
            },
            query() {
                if (this.type === "myFollowers") {
                    return graphql.myFollowers;
                }else if(this.type === "myFollowing") {
                    return graphql.myFollowing;
                }else if (this.type === "followers") {
                    return graphql.followers;
                }else if(this.type === "following") {
                    return graphql.following;
                }else {
                    return graphql.users;
                }
            },
            variables() {
                var variables = {count: this.count, page: this.page};
                if (this.type === "followers" || this.type === "following") {
                    variables["id"] = this.user.id;
                }

                return variables;
            }
        },
        methods: {
            fetchUsers() {
                this.loaded = false;
                this.users = [];
                axios.post(graphql.api, {
                    query: this.query,
                    variables: this.variables
                }).then(this.loadUsers).catch(function (error) {});
            },
            loadUsers(response) {
                this.loaded = true;
                if (this.type === "myFollowers") {
                    this.users = response.data.data.me.followers.data;
                    this.paginatorInfo = response.data.data.me.followers.paginatorInfo;
                }else if(this.type === "myFollowing") {
                    this.users = response.data.data.me.following.data;
                    this.paginatorInfo = response.data.data.me.following.paginatorInfo;
                }else if (this.type === "followers") {
                    this.users = response.data.data.user.followers.data;
                    this.paginatorInfo = response.data.data.user.followers.paginatorInfo;
                }else if(this.type === "following") {
                    this.users = response.data.data.user.following.data;
                    this.paginatorInfo = response.data.data.user.following.paginatorInfo;
                }else {
                    this.users = response.data.data.users.data;
                    this.paginatorInfo = response.data.data.users.paginatorInfo;
                }
            },
            loadPage(page) {
                this.page = page;
                this.fetchUsers();
            },
            isMe(id) {
                return parseInt(this.me.id) === parseInt(id);
            }
        }
    }
</script>

<style scoped>

</style>