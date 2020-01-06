<template>
    <div class="directory-area">
        <div class="card card-small h-100 main">
            <div class="card-body h-100 p-0 bg-white">
                <div class="card card-small border-radius-0 h-100" style="background: unset !important;">
                    <div class="card-header border-radius-0 profile-header" style="height: 120px !important;">
                    </div>
                    <div class="card-body p-4 profile-body bg-white border-top h-100">
                        <div style="position: relative; top: -100px !important;">
                            <header class="d-flex justify-content-between align-items-start mb-2">
                                <visible-items :paginator-info="paginatorInfo" v-if="showEscrows && loaded && paginatorInfo"></visible-items>
                                <span class="visible-items" v-else></span>
                                <div class="ml-auto">
                                    <select class="form-control form-control-sm custom-select custom-select-sm" tabindex="-98" v-model="type">
                                        <option value=""></option>
                                        <option value="incoming">Incoming</option>
                                        <option value="outgoing">Outgoing</option>
                                    </select>
                                </div>
                            </header>
                            <div class="card card-small border-bottom border-left border-right lo-stats border-top-radius-0">
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
                                        <tr v-if="!loaded || (!showEscrows && loaded)">
                                            <td colspan="4" class="p-2">
                                                <div align="center" v-if="!loaded">
                                                    <loader></loader>
                                                    <p class="m-0">Loading ...</p>
                                                </div>
                                                <div align="center" v-if="!showEscrows && loaded">
                                                    <h4 class="m-0"><i class="material-icons">error</i></h4>
                                                    <p class="m-0">You have no pending escrow yet!</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr v-if="showEscrows && loaded" is="escrow-row" v-for="(escrow, indx) in escrows" :escrow="escrow" :key="indx"></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <pagination v-if="paginatorInfo" class="my-2" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import EscrowRow from "./EscrowRow";
    export default {
        name: "Escrow",
        components: {EscrowRow},
        data() {
            return {
                escrows: [],
                page: 1,
                loaded: false,
                paginatorInfo: null,
                type: ''
            }
        },
        created () {
            this.fetchEscrows();
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
            showEscrows() {
                return this.escrows.length > 0;
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
            fetchEscrows() {
                this.escrows = [];
                this.loaded = false;
                axios.post(graphql.api, {
                    query: graphql.accountEscrows,
                    variables: this.variables
                }).then(this.loadEscrows).catch(function (error) {});
            },
            loadEscrows(escrows) {
                this.loaded = true;
                this.escrows = escrows.data.data.account.escrows.data;
                this.paginatorInfo = escrows.data.data.account.escrows.paginatorInfo;
            },
            loadPage(page) {
                this.page = page;
                this.fetchEscrows();
            }
        },
        watch: {
            '$route': 'fetchEscrows',
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