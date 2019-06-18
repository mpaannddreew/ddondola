<template>
    <div class="directory-list border-right">
        <div class="card card-small">
            <div class="card-header border-bottom bg-light">
                <div class="input-group input-group-seamless">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="material-icons">folder</i>
                        </div>
                    </div>
                    <select class="form-control form-control-md custom-select custom-select-md" tabindex="-1" aria-hidden="true">
                        <option>All Users</option>
                    </select>
                </div>
            </div>
            <div class="card-body h-100">
                <div class="input-group input-group-seamless m-2"
                     style="min-width: unset !important; width: unset !important;">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <input class="form-control bg-light" type="text" placeholder="Filter Users" aria-label="Search">
                </div>
                <template v-if="!loaded || (!hasUsers && loaded)">
                    <div align="center" v-if="!loaded">
                        <div class="loader"></div>
                        <p class="m-0">Loading users...</p>
                    </div>
                    <div align="center" v-if="!hasUsers && loaded">
                        <h4 class="m-0"><i class="material-icons">error</i></h4>
                        <p class="m-0">This directory is empty!</p>
                    </div>
                </template>
                <ul class="contact-list" v-if="hasUsers && loaded">
                    <li is="user" v-for="(user, indx) in users" :user="user" :key="indx"></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import User from "./User";
    export default {
        name: "Users",
        components: {User},
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
        computed: {
            hasUsers() {
                return this.users.length > 0;
            },
            query() {
                return graphql.users;
            },
            variables() {
                return {myCountry: false, count: graphql.columnCount, page: this.page};
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
            }
        }
    }
</script>

<style scoped>

</style>