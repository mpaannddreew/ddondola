<template>
    <div>
        <div class="mb-2">
            <div class="row no-gutters">
                <div class="col-12 col-sm-6 mb-2 mb-lg-0">
                    <form class="ddondola-search">
                        <div class="input-group input-group-seamless">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="material-icons"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control form-control-sm" placeholder="Filter people">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card card-small lo-stats border">
            <table class="table mb-0">
                <thead class="py-2 bg-light text-semibold border-bottom">
                <tr>
                    <th>Details</th>
                    <th></th>
                    <th class="text-right"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="!loaded || (!hasUsers && loaded)">
                   <td colspan="3" class="p-2">
                       <div align="center" v-if="!loaded">
                           <div class="loader"></div>
                           <p class="m-0">Loading people...</p>
                       </div>
                       <div align="center" v-if="!hasUsers && loaded">
                           <h4 class="m-0"><i class="material-icons">error</i></h4>
                           <p class="m-0">This directory is empty!</p>
                       </div>
                   </td>
                </tr>
                <tr v-if="hasUsers && loaded" is="person" v-for="(_user, indx) in users" :key="indx" :user="_user" :indx="indx" :admin="true"></tr>
                </tbody>
            </table>
        </div>
        <pagination v-if="paginatorInfo" class="my-4" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
    </div>
</template>

<script>
    import Person from "./users/Person";
    export default {
        name: "People",
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
            }
        }
    }
</script>

<style scoped>

</style>