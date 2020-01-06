<template>
    <div class="directory">
        <div class="directory-list close-directory-list">
            <div class="card card-small h-100 main">
                <div class="card-body" style="overflow-y: hidden; overflow-x: hidden; background: #f5f6f8 !important;">
                    <div class="input-group input-group-seamless mx-2 mt-2" style="min-width: unset !important; width: unset !important;">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                        <input class="form-control" type="text" aria-label="Search">
                    </div>
                    <div class="h-100" style="overflow-y: auto; overflow-x: hidden; height: calc(99.9vh - 6.4rem - 1px) !important; background: #f5f6f8 !important;">
                        <div class="center-xy" v-if="!loaded && !showWallets || !showWallets && loaded">
                            <div align="center" v-if="!loaded && !showWallets">
                                <div class="loader"></div>
                                <p>loading wallets...</p>
                            </div>
                            <div align="center" v-else-if="!showWallets && loaded">
                                <h4 class="m-0"><i class="material-icons">error</i></h4>
                                <p class="m-0">No wallets.</p>
                            </div>
                        </div>
                        <ul class="list-group" v-if="loaded && showWallets" style="background: unset !important;">
                            <li class="list-group-item border-0 p-0 mx-2 mb-0 mt-2" style="background: unset !important;" v-for="(wallet, indx) in wallets">
                                <wallet-item :key="indx" :wallet="wallet"></wallet-item>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
    import WalletItem from "./WalletItem";
    export default {
        name: "Wallets",
        components: {WalletItem},
        data() {
            return {
                wallets: [1, 2],
                loaded: true
            }
        },
        computed: {
            showWallets() {
                return this.wallets.length > 0;
            }
        },
        methods: {

        }
    }
</script>

<style scoped>
    .directory, .directory .card.main {
        height: calc(99.9vh - 3.75rem - 1px) !important;
    }

    .nav-link {
        margin: 0 !important;
    }

    .nav-item {
        border-right:1px solid #e1e5eb!important;
    }

    .nav-item:last-child {
        border-right: none !important;
    }
</style>