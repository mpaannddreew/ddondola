<template>
    <div class="directory">
        <div class="directory-list close-directory-list">
            <div class="card card-small h-100 border-right main">
                <div class="card-body h-100 p-0">
                    <div class="card user-details card-dark bg-secondary-gradient text-white" style="border-radius: 0px !important;">
                        <div class="card-body skew-shadow py-5" style="margin-top: 0; !important;">
                            <template v-if="loaded">
                                <!--<div class="user-details__avatar mx-auto border lis-border-width-4 bg-white rounded"-->
                                     <!--style="border: medium solid rgb(255, 255, 255) !important; width: 70px !important;">-->
                                    <!--<img :src="holder.avatar.url" alt="Avatar">-->
                                <!--</div>-->
                                <!--<h6 class="text-ellipsis text-center m-0 mt-2 mb-4 text-white" style="display: block;">{{ holder.name }}</h6>-->
                                <div class="row">
                                    <div class="col-md-6 border-right" align="center">
                                        <p class="text-white mb-0" style="font-size: smaller !important;">Actual balance</p>
                                        <h5 class="text-white">{{ account.actualBalance|commas }}</h5>
                                    </div>
                                    <div class="col-md-6" align="center">
                                        <p class="text-white mb-0" style="font-size: smaller !important;">Available balance</p>
                                        <h5 class="text-white">{{ account.balance|commas }}</h5>
                                    </div>
                                </div>
                            </template>
                            <div align="center" v-else>
                                <loader></loader>
                                <p class="m-0 text-white">Loading ...</p>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="javascript:void(0)" @click="transactions"
                           class="list-group-item list-group-item-action d-flex">
                            <div class="my-auto w-100">
                                <div>
                                    <p class="text-ellipsis m-0" style="font-weight: normal">Transactions</p>
                                    <p class="text-ellipsis m-0 text-muted" style="font-size: smaller">Track your transaction history</p>
                                </div>
                            </div>
                            <i class="material-icons my-auto d-flex">payment</i>
                        </a>
                        <a href="javascript:void(0)" @click="deposit"
                           class="list-group-item list-group-item-action d-flex">
                            <div class="my-auto w-100">
                                <div>
                                    <p class="text-ellipsis m-0" style="font-weight: normal">Deposit</p>
                                    <p class="text-ellipsis m-0 text-muted" style="font-size: smaller">Top up your wallet balance</p>
                                </div>
                            </div>
                            <i class="material-icons my-auto d-flex">trending_up</i>
                        </a>
                        <a href="javascript:void(0)" @click="withdraw"
                           class="list-group-item list-group-item-action d-flex">
                            <div class="my-auto w-100">
                                <div>
                                    <p class="text-ellipsis m-0" style="font-weight: normal">Withdraw</p>
                                    <p class="text-ellipsis m-0 text-muted" style="font-size: smaller">Track your withdraw requests</p>
                                </div>
                            </div>
                            <i class="material-icons my-auto d-flex">trending_down</i>
                        </a>
                        <a href="javascript:void(0)" @click="escrow"
                           class="list-group-item list-group-item-action d-flex">
                            <div class="my-auto w-100">
                                <div>
                                    <p class="text-ellipsis m-0" style="font-weight: normal">Escrow</p>
                                    <p class="text-ellipsis m-0 text-muted" style="font-size: smaller">Monitor your escrow transactions</p>
                                </div>
                            </div>
                            <i class="material-icons my-auto d-flex">hourglass_empty</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "Wallet",
        mounted() {
            this.load();
        },
        data() {
            return {
                loaded: false,
                account: null
            }
        },
        props: {
            shop: {
                type: String,
            },
            admin: {
                type: Boolean,
                default: false
            }
        },
        computed: {
            basePath() {
                if (this.admin) {
                    return '/admin/wallet';
                }

                if (this.shop) {
                    return `/shops/${this.shop}/wallet`;
                }

                return '/me/wallet';
            },
            variables() {
                if (this.admin) {
                    return {accountHolder: 'admin'};
                }

                if (this.shop) {
                    return {accountHolder: this.shop};
                }

                return {};
            },
        },
        methods: {
            transactions() {
                if (this.$route.path !== this.basePath)
                    this.$router.push(this.basePath);
            },
            deposit() {
                if (!_.includes(this.$route.path, `${this.basePath}/deposit`))
                    this.$router.push(`${this.basePath}/deposit`);
            },
            withdraw() {
                if (this.$route.path !== `${this.basePath}/withdraw`)
                    this.$router.push(`${this.basePath}/withdraw`);
            },
            escrow() {
                if (!_.includes(this.$route.path, `${this.basePath}/escrow`))
                    this.$router.push(`${this.basePath}/escrow`);
            },
            load() {
                axios.post(graphql.api, {query: graphql.account, variables: this.variables})
                    .then(this.prepare).catch(function (error) {})
            },
            prepare(response) {
                this.loaded = true;
                this.account = response.data.data.account;
            },
        }
    }
</script>

<style scoped>
    .directory {
        height: calc(99.9vh - 3.75rem - 1px) !important;
    }

    .directory .card.main {
        height: calc(99.9vh - 3.75rem - 1px) !important;
    }
</style>