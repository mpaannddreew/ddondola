<template>
    <div class="directory-area">
        <div class="card card-small h-100 main">
            <div class="card-header p-2 bg-white border-bottom">
                <header class="d-flex justify-content-between align-items-start m-0">
                    <visible-items :paginator-info="paginatorInfo" v-if="showRequests && loaded && paginatorInfo"></visible-items>
                    <span class="visible-items" v-else></span>
                    <div class="ml-auto d-flex">
                        <select class="form-control form-control-sm custom-select custom-select-sm" tabindex="-98" v-model="type">
                            <option value=""></option>
                            <option value="pending">Pending</option>
                            <option value="successful">Successful</option>
                        </select>
                        <a class="btn btn-success btn-sm ml-1" @click="create" href="javascript:void(0)"><i class="fa fa-plus"></i> Create</a>
                    </div>
                </header>
            </div>
            <div class="card-body h-100 p-2">
                <div class="card card-small border lo-stats border-top-radius-0">
                    <div class="card-body p-0" style="min-height: unset !important;">
                        <table class="table mb-0">
                            <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">Ref ID</th>
                                <th scope="col" class="border-0 text-center">Amount</th>
                                <th scope="col" class="border-0 text-center">Status</th>
                                <th scope="col" class="border-0 text-center">Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="!loaded || (!showRequests && loaded)">
                                <td colspan="4" class="p-2">
                                    <div align="center" v-if="!loaded">
                                        <loader></loader>
                                        <p class="m-0">Loading ...</p>
                                    </div>
                                    <div align="center" v-if="!showRequests && loaded">
                                        <h4 class="m-0"><i class="material-icons">error</i></h4>
                                        <p class="m-0">You have not made any withdraw requests yet!</p>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="showRequests && loaded" is="withdraw-request" v-for="(request, indx) in requests" :withdraw-request="request" :key="indx"></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <pagination v-if="paginatorInfo" class="my-2" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
            </div>
        </div>
    </div>
</template>

<script>
    import WithdrawRequest from "./WithdrawRequest";
    export default {
        name: "Withdraw",
        components: {WithdrawRequest},
        data() {
            return {
                password: '',
                requests: [],
                page: 1,
                loaded: false,
                paginatorInfo: null,
                type: ''
            }
        },
        created () {
            this.fetchRequests();
        },
        props: {
            shop: {
                type: String
            },
            admin: {
                type: Boolean,
                default: false
            }
        },
        computed: {
            basePath() {
                if (this.admin) {
                    return '/admin/wallet/withdraw';
                }

                if (this.shop) {
                    return `/shops/${this.shop}/wallet/withdraw`;
                }

                return '/me/wallet/withdraw';
            },
            showRequests() {
                return this.requests.length > 0;
            },
            variables() {
                var variables = {count: graphql.rowCount, page: this.page};
                if (this.shop) {
                    variables["accountHolder"] = this.shop;
                }

                if (this.admin) {
                    variables["accountHolder"] = 'admin';
                }

                if (this.type) {
                    variables["type"] = this.upper(this.type);
                }

                return variables;
            }
        },
        methods: {
            fetchRequests() {
                this.requests = [];
                this.loaded = false;
                axios.post(graphql.api, {
                    query: graphql.accountWithdrawRequests,
                    variables: this.variables
                }).then(this.loadRequests).catch(function (error) {});
            },
            loadRequests(requests) {
                this.loaded = true;
                this.requests = requests.data.data.account.withdrawRequests.data;
                this.paginatorInfo = requests.data.data.account.withdrawRequests.paginatorInfo;
            },
            loadPage(page) {
                this.page = page;
                this.fetchRequests();
            },
            create() {
                this.$router.push(`${this.basePath}/create`);
            }
        },
        watch: {
            '$route': 'fetchRequests',
            type(data) {
                this.loadPage(1);
            },
        }
    }
</script>

<style scoped>
    .directory .card.main {
        height: calc(99.9vh - 3.75rem - 1px) !important;
    }

    .lo-stats thead th {
        font-weight: bold !important;
    }
</style>