<template>
    <div class="directory-area">
        <div class="card card-small h-100 main">
            <div class="card-header p-2 border-bottom bg-light">
                <header class="d-flex justify-content-between align-items-start m-0">
                    <visible-items :paginator-info="paginatorInfo" v-if="showTransactions && loaded && paginatorInfo"></visible-items>
                    <span class="visible-items" v-else></span>
                    <div class="ml-auto">
                        <select class="form-control form-control-sm custom-select custom-select-sm" tabindex="-98" v-model="type">
                            <option value=""></option>
                            <option value="debit">Debits</option>
                            <option value="credit">Credits</option>
                        </select>
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
                            <tr v-if="!loaded || (!showTransactions && loaded)">
                                <td colspan="4" class="p-2">
                                    <div align="center" v-if="!loaded">
                                        <loader></loader>
                                        <p class="m-0">Loading ...</p>
                                    </div>
                                    <div align="center" v-if="!showTransactions && loaded">
                                        <h4 class="m-0"><i class="material-icons">error</i></h4>
                                        <p class="m-0">You have not made any transactions yet!</p>
                                    </div>
                                </td>
                            </tr>
                            <tr v-else-if="showTransactions && loaded" is="transaction" v-for="(transaction, indx) in transactions" :transaction="transaction" :key="indx"></tr>
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
    import Transaction from "./Transaction";
    export default {
        name: "Transactions",
        components: {Transaction},
        data() {
            return {
                transactions: [],
                page: 1,
                loaded: false,
                paginatorInfo: null,
                type: ''
            }
        },
        created () {
            this.fetchTransactions();
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
            showTransactions() {
                return this.transactions.length > 0;
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
            fetchTransactions() {
                this.transactions = [];
                this.loaded = false;
                axios.post(graphql.api, {
                    query: graphql.accountTransactions,
                    variables: this.variables
                }).then(this.loadTransactions).catch(function (error) {});
            },
            loadTransactions(transactions) {
                this.loaded = true;
                this.transactions = transactions.data.data.account.transactions.data;
                this.paginatorInfo = transactions.data.data.account.transactions.paginatorInfo;
            },
            loadPage(page) {
                this.page = page;
                this.fetchTransactions();
            }
        },
        watch: {
            '$route': 'fetchTransactions',
            type(data) {
                this.loadPage(1);
            },
        }
    }
</script>

<style scoped>
    .nav-link {
        margin: 0 !important;
    }

    .nav-item {
        border-right:1px solid #e1e5eb!important;
    }

    .nav-item:last-child {
        border-right: none !important;
    }

    .directory .card.main {
        height: calc(99.9vh - 3.75rem - 1px) !important;
    }

    .lo-stats thead th {
        font-weight: bold !important;
    }
</style>