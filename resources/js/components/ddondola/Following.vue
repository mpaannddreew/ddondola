<template>
    <div>
        <div v-if="!loaded || (!hasUsers && loaded)" class="border p-3 border-radius border-top-radius-0">
            <div align="center" v-if="!loaded">
                <div class="loader"></div>
                <p class="m-0">Loading following...</p>
            </div>
            <div align="center" v-if="!hasUsers && loaded">
                <h4 class="m-0"><i class="material-icons">error</i></h4>
                <p class="m-0">No following yet!</p>
            </div>
        </div>
        <div class="card card-small lo-stats border border-top-radius-0" v-else-if="hasUsers && loaded">
            <table class="table mb-0">
                <tbody>
                    <tr is="person" v-for="(_user, indx) in users" :key="indx" :user="_user" :is-me="isMe(_user.id)" :indx="indx"></tr>
                </tbody>
            </table>
        </div>
        <pagination v-if="paginatorInfo" class="my-4" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
    </div>
</template>

<script>
    import Person from "./users/Person";
    export default {
        name: "Following",
        components: {Person},
        mounted() {
            this.fetchUsers();
            this.watchFollowing();
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
            },
            channel() {
                return `user.${this.user ? this.user.code: this.me.code}.followers`;
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
                if (this.auth && !this.admin)
                    return parseInt(this.me.id) === parseInt(id);

                return false;
            },
            watchFollowing() {
                Echo.channel(this.channel)
                    .listen('.user.followed', (e) => {
                        if(this.users.length !== graphql.columnCount) {
                            this.users.push(e.followable);
                        }
                    })
                    .listen('.user.unfollowed', (e) => {
                        this.users = _.reject(this.users, (user) => {
                            return user.id.toString() === e.followable.id.toString();
                        });
                    });
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