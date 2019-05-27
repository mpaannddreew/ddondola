<template>
    <div>
        <div class="mb-2">
            <div class="row no-gutters">
                <div class="col-12 col-sm-6 mb-2 mb-lg-0">
                    <div class="input-group input-group-seamless">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="material-icons"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control form-control-sm" placeholder="Filter people">
                    </div>
                </div>
                <div class="col-12 col-sm-6 d-flex align-items-center">
                    <div class="btn-group btn-group-sm ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0">
                        <select class="form-control form-control-sm custom-select custom-select-sm" tabindex="-98">
                            <option value="latest">Name [A-Z]</option>
                            <option value="oldest">Name [Z-A]</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-small border" v-if="!loaded || (!hasUsers && loaded)">
            <div class="card-body">
                <div align="center" v-if="!loaded">
                    <div class="loader"></div>
                    <p class="m-0">Loading people...</p>
                </div>
                <div align="center" v-if="!hasUsers && loaded">
                    <h4 class="m-0"><i class="material-icons">error</i></h4>
                    <p class="m-0">This directory is empty!</p>
                </div>
            </div>
        </div>
        <div class="card card-small lo-stats border" v-if="hasUsers && loaded">
            <table class="table mb-0">
                <tbody>
                <tr is="user-row" v-for="(_user, indx) in users" :key="indx" :user="_user" :is-me="isMe(_user.id)" :auth="auth" :indx="indx"></tr>
                </tbody>
            </table>
        </div>
        <pagination v-if="paginatorInfo" class="my-4" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
    </div>
</template>

<script>
    import UserRow from "./users/UserRow";
    export default {
        name: "Users",
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
            me: {
                type: Object,
                required: false
            }
        },
        computed: {
            hasUsers() {
                return this.users.length > 0;
            },
            query() {
                return graphql.users;
            },
            variables() {
                return {count: graphql.columnCount, page: this.page};
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
                this.users = response.data.data.users.data;
                this.paginatorInfo = response.data.data.users.paginatorInfo;
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