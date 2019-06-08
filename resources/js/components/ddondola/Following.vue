<template>
    <div>
        <div class="card card-small lo-stats border">
            <div class="card-header border-bottom">
                <h5 class="m-0"><i class="material-icons">people_outline</i> Following</h5>
            </div>
            <table class="table mb-0">
                <tbody>
                <template v-if="!loaded || (!hasUsers && loaded)">
                    <tr>
                        <td style="border-top: none !important;">
                            <div align="center" v-if="!loaded">
                                <div class="loader"></div>
                                <p class="m-0">Loading following...</p>
                            </div>
                            <div align="center" v-if="!hasUsers && loaded">
                                <h4 class="m-0"><i class="material-icons">error</i></h4>
                                <p class="m-0">No following yet!</p>
                            </div>
                        </td>
                    </tr>
                </template>
                <template v-else-if="hasUsers && loaded">
                    <tr is="user-row" v-for="(_user, indx) in users" :key="indx" :user="_user" :is-me="isMe(_user.id)" :auth="auth" :indx="indx"></tr>
                </template>
                </tbody>
            </table>
        </div>
        <pagination v-if="paginatorInfo" class="my-4" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
    </div>
</template>

<script>
    import UserRow from "./users/UserRow";
    export default {
        name: "Followers",
        components: {UserRow},
        mounted() {
            this.fetchUsers();
        },
        data() {
            return {
                users: [],
                page: 1,
                loaded: false,
                paginatorInfo: null
            }
        },
        props: {
            user: {
                type: Object,
                required: false
            },
            me: {
                type: Object,
                required: false
            },
            auth: {
                type: Boolean,
                required: false,
                default: true
            }
        },
        computed: {
            hasUsers() {
                return this.users.length > 0;
            },
            query() {
                if (this.user) {
                    return graphql.following;
                }

                return graphql.myFollowing;
            },
            variables() {
                var variables = {count: graphql.columnCount, page: this.page};
                if (this.user) {
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
                if (this.user) {
                    this.users = response.data.data.user.following.data;
                    this.paginatorInfo = response.data.data.user.following.paginatorInfo;
                }else {
                    this.users = response.data.data.me.following.data;
                    this.paginatorInfo = response.data.data.me.following.paginatorInfo;
                }
            },
            loadPage(page) {
                this.page = page;
                this.fetchUsers();
            },
            isMe(id) {
                if (this.auth)
                    return parseInt(this.me.id) === parseInt(id);

                return false;
            }
        }
    }
</script>

<style scoped>
    .lo-stats table {
        min-width: unset !important;
    }

    table tr:first-child td {
        border-top: none !important;
    }
</style>