<template>
    <div>
        <div class="card card-small lo-stats border">
            <table class="table mb-0">
                <tbody>
                <template v-if="!loaded || (!hasUsers && loaded)">
                    <tr>
                        <td style="border-top: none !important;" class="p-3">
                            <div align="center" v-if="!loaded">
                                <div class="loader"></div>
                                <p class="m-0">Loading followers...</p>
                            </div>
                            <div align="center" v-if="!hasUsers && loaded">
                                <h4 class="m-0"><i class="material-icons">error</i></h4>
                                <p class="m-0">No followers yet!</p>
                            </div>
                        </td>
                    </tr>
                </template>
                <template v-else-if="hasUsers && loaded">
                    <tr is="person" v-for="(_user, indx) in users" :key="indx" :user="_user" :is-me="isMe(_user.id)" :indx="indx" :admin="admin"></tr>
                </template>
                </tbody>
            </table>
        </div>
        <pagination v-if="paginatorInfo" class="my-4" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
    </div>
</template>

<script>
    import Person from "./users/Person";
    export default {
        name: "Followers",
        components: {Person},
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
            admin: {
                type: Boolean,
                default: false
            }
        },
        computed: {
            hasUsers() {
                return this.users.length > 0;
            },
            query() {
                if (this.user) {
                    return graphql.followers;
                }

                return graphql.myFollowers;
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
                    this.users = response.data.data.user.followers.data;
                    this.paginatorInfo = response.data.data.user.followers.paginatorInfo;
                }else {
                    this.users = response.data.data.me.followers.data;
                    this.paginatorInfo = response.data.data.me.followers.paginatorInfo;
                }
            },
            loadPage(page) {
                this.page = page;
                this.fetchUsers();
            },
            isMe(id) {
                if (this.auth && ! this.admin)
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
</style>