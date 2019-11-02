<template>
    <div class="directory-area">
        <div class="card card-small h-100 main">
            <div class="card-header p-2 bg-light border-bottom">
                <header class="d-flex justify-content-between align-items-start m-0">
                    <visible-items :paginator-info="paginatorInfo" v-if="showRequests && loaded && paginatorInfo"></visible-items>
                    <span class="visible-items" v-else></span>
                    <div class="ml-auto d-flex">
                        <select class="form-control form-control-sm custom-select custom-select-sm" tabindex="-98" v-model="type">
                            <option value=""></option>
                            <option value="pending">Pending</option>
                            <option value="successful">Successful</option>
                        </select>
                        <a class="btn btn-success btn-sm ml-1" data-toggle="modal" href="#withdraw-request">New Request</a>
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
                                <th scope="col" class="border-0 text-center">Payment</th>
                                <th scope="col" class="border-0 text-center">Amount</th>
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
                                        <p class="m-0">You have not made any requests yet!</p>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <pagination v-if="paginatorInfo" class="my-2" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
                <div class="modal fade" id="withdraw-request" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-small">
                                    <div class="card-header border-bottom">
                                        Withdraw
                                    </div>
                                    <div class="card-body">
                                        <div class="input-group border-0">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text border-0">
                                                    <i class="material-icons">dialpad</i>
                                                </div>
                                            </div>
                                            <input class="form-control form-control-lg border-0" v-model="amount" type="text" placeholder="Amount">
                                        </div>
                                        <div class="input-group border-0 border-top border-bottom">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text border-0">
                                                    <i class="material-icons">phone</i>
                                                </div>
                                            </div>
                                            <input class="form-control form-control-lg border-0" v-model="phone" type="text" placeholder="Phone">
                                        </div>
                                        <div class="input-group border-0">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text border-0">
                                                    <i class="material-icons">lock</i>
                                                </div>
                                            </div>
                                            <input class="form-control form-control-lg border-0" v-model="password" type="text" placeholder="Password">
                                        </div>
                                        <vue-tel-input v-model="phone" defaultCountry="UG" :onlyCountries="['UG']"></vue-tel-input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Withdraw",
        data() {
            return {
                amount: '',
                phone: '',
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