<template>
    <div class="directory-area">
        <div class="card card-small h-100" v-if="!loaded && !loadedUser">
            <div class="card-body">
                <div class="center-xy">
                    <div align="center">
                        <div class="loader"></div>
                        <p>Loading user...</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-small" v-if="loaded && loadedUser">
            <div class="card-header p-0">
                <div class="header-navbar collapse d-lg-flex p-0 bg-white border-bottom">
                    <div class="container p-0 px-4">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link" :class="{active: activeTab('account')}" @click="showTab('account')">
                                    <i class="material-icons">account_circle</i> Account
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link" :class="{active: activeTab('followers')}" @click="showTab('followers')">
                                    <i class="material-icons">people</i> Followers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link" :class="{active: activeTab('following')}" @click="showTab('following')">
                                    <i class="material-icons">people_outline</i> Following
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link" :class="{active: activeTab('shops')}" @click="showTab('shops')">
                                    <i class="material-icons">shop_two</i> Shops
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link" :class="{active: activeTab('cart')}" @click="showTab('cart')">
                                    <i class="material-icons">shopping_cart</i> Cart
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link" :class="{active: activeTab('orders')}" @click="showTab('orders')">
                                    <i class="material-icons">description</i> Orders
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link" :class="{active: activeTab('payments')}" @click="showTab('payments')">
                                    <i class="material-icons">credit_card</i> Payments
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link" :class="{active: activeTab('wallet')}" @click="showTab('wallet')">
                                    <i class="material-icons">account_balance_wallet</i> Wallet
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body h-100 p-2">
                <div v-if="activeTab('account')">account</div>
                <div v-if="activeTab('followers')">followers</div>
                <div v-if="activeTab('following')">following</div>
                <div v-if="activeTab('shops')">shops</div>
                <div v-if="activeTab('cart')">cart</div>
                <div v-if="activeTab('orders')">orders</div>
                <div v-if="activeTab('payments')">payments</div>
                <div v-if="activeTab('wallet')">wallet</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserAdmin",
        data() {
            return {
                tab: 'details',
                loaded: false,
                loadedUser: null
            }
        },
        created () {
            this.loadUser();
        },
        props: {
            user: {
                type: String,
                required: true
            }
        },
        computed: {
            usersRoute() {
                return "/admin/users";
            }
        },
        methods: {
            transitionBack() {
                this.$router.push(this.usersRoute);
            },
            showTab(tab) {
                this.tab = tab;
            },
            activeTab(tab) {
                return this.tab === tab;
            },
            loadUser() {
                this.loaded = false;
                this.loadedUser = null;
                axios.post(graphql.api, {
                    query: graphql.userByCode,
                    variables: {user: this.user}
                }).then(this.loadUserDetails).catch(function (error) {});
            },
            loadUserDetails(response) {
                this.loaded = true;
                this.loadedUser = response.data.data.user;
                this.showTab('account');
            }
        },
        watch: {
            '$route': 'loadUser',
        }
    }
</script>

<style scoped>

</style>