<template>
    <div class="directory">
        <div class="directory-list close-directory-list">
            <div class="card card-small h-100 border-right main">
                <div class="card-body h-100 p-0">
                    <div class="card card-dark bg-secondary-gradient text-white" style="border-radius: 0px !important;">
                        <div class="card-body skew-shadow">
                            <template v-if="loaded">
                                <div class="d-flex">
                                    <div class="sc-stats__image">
                                        <img class="border rounded" :src="holder.avatar.url" style="border: medium solid rgb(255, 255, 255) !important;">
                                    </div>
                                    <div class="ml-2 my-auto w-100">
                                    <span class="text-ellipsis" style="display: block;">
                                        {{ holder.name }}
                                    </span>
                                    </div>
                                </div>
                                <p class="text-white mt-4 mb-0" style="font-size: smaller !important;">Available balance</p>
                                <h3 class="text-white">{{ account.balance|commas }}</h3>
                            </template>
                            <div align="center" v-else>
                                <loader></loader>
                                <p class="m-0 text-white">Loading ...</p>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="javascript:void(0)" @click="transactions"
                           class="list-group-item list-group-item-action d-flex" :class="disabled">
                            <div class="sc-stats__image">
                                <img class="rounded" src="/images/wallet/transactions_ico.png">
                            </div>
                            <div class="ml-2 my-auto d-flex w-100">
                                <span class="text-ellipsis" style="display: block;">
                                    Transactions
                                </span>
                                <small class="text-muted ml-auto"><i class="fa fa-arrow-circle-o-right"></i></small>
                            </div>
                        </a>
                        <a href="javascript:void(0)" @click="deposit"
                           class="list-group-item list-group-item-action d-flex" :class="disabled">
                            <div class="sc-stats__image">
                                <img class="rounded" src="/images/wallet/deposit_ico.png">
                            </div>
                            <div class="ml-2 my-auto d-flex w-100">
                                <span class="text-ellipsis" style="display: block;">
                                    Deposit
                                </span>
                                <small class="text-muted ml-auto"><i class="fa fa-arrow-circle-o-right"></i></small>
                            </div>
                        </a>
                        <a href="javascript:void(0)" @click="withdraw"
                           class="list-group-item list-group-item-action d-flex" :class="disabled">
                            <div class="sc-stats__image">
                                <img class="rounded" src="/images/wallet/withdraw_ico.png">
                            </div>
                            <div class="ml-2 my-auto d-flex w-100">
                                <span class="text-ellipsis" style="display: block;">
                                    Withdraw
                                </span>
                                <small class="text-muted ml-auto"><i class="fa fa-arrow-circle-o-right"></i></small>
                            </div>
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
                account: 0
            }
        },
        props: {
            holder: {
                type: Object,
                required: true
            },
            holderType: {
                type: String,
                default: 'user'
            }
        },
        computed: {
            basePath() {
                return this.holderType === 'user' ? '/me/wallet': `/shops/${this.holder.code}/wallet`;
            },
            disabled() {
                return {
                    disabled: !this.loaded
                }
            },
            variables() {
                return {accountHolder: this.holder.code};
            },
        },
        methods: {
            transactions() {
                this.$router.push(this.basePath);
            },
            deposit() {
                this.$router.push(`${this.basePath}/deposit`);
            },
            withdraw() {
                this.$router.push(`${this.basePath}/withdraw`);
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