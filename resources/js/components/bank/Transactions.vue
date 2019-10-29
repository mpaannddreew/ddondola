<template>
    <div class="directory-area">
        <div class="card card-small h-100 main">
            <div class="card-header p-2 border-bottom bg-white">
                <div class="container">
                    <header class="d-flex justify-content-between align-items-start m-0">
                        <visible-items :paginator-info="paginatorInfo" v-if="showTransactions && loaded && paginatorInfo"></visible-items>
                        <span class="visible-items" v-else></span>
                        <div class="btn-group">
                            <select class="form-control custom-select custom-select-sm" tabindex="-98" v-model="showing">
                                <option value=""></option>
                                <option value="latest">Debits</option>
                                <option value="oldest">Credits</option>
                            </select>
                        </div>
                    </header>
                </div>
            </div>
            <div class="card-body h-100 p-2">
                <div class="center-xy" v-if="!loaded || (!showTransactions && loaded)">
                    <div align="center" v-if="!loaded">
                        <loader></loader>
                        <p class="m-0">Loading transaction history...</p>
                    </div>
                    <div align="center" v-if="!showTransactions && loaded">
                        <h4 class="m-0"><i class="material-icons">error</i></h4>
                        <p class="m-0">You have not made any transactions yet!</p>
                    </div>
                </div>
                <div v-else-if="showTransactions && loaded">
                    <div class="card card-small border">
                        <div class="card-body text-center">

                        </div>
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
                showing: ''
            }
        },
        created () {
            this.fetchTransactions()
        },
        props: {
            shop: {
                type: String
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

                return variables;
            }
        },
        methods: {
            fetchTransactions() {
                this.transactions = [];
                this.loaded = false;
                axios.post(graphql.api, {
                    query: graphql.AccountTransactions,
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
            showing(data) {
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
</style>