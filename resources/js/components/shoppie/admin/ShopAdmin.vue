<template>
    <div class="directory-area">
        <div class="card card-small h-100" v-if="!loaded && !loadedShop">
            <div class="card-body">
                <div class="center-xy">
                    <div align="center">
                        <div class="loader"></div>
                        <p>Loading shop...</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-small" v-if="loaded && loadedShop">
            <div class="card-header p-0">
                <div class="header-navbar collapse d-lg-flex p-0 bg-white sticky border-bottom">
                    <div class="container p-0 px-4">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link" :class="{active: activeTab('details')}" @click="showTab('details')">
                                    <i class="material-icons">shop_two</i> Details
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link" :class="{active: activeTab('insights')}" @click="showTab('insights')">
                                    <i class="material-icons">show_chart</i> Insights
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link" :class="{active: activeTab('products')}" @click="showTab('products')">
                                    <i class="material-icons">local_mall</i> Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link" :class="{active: activeTab('categories')}" @click="showTab('categories')">
                                    <i class="material-icons">folder_open</i> Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link" :class="{active: activeTab('sub-categories')}" @click="showTab('sub-categories')">
                                    <i class="material-icons">folder_open</i> Sub Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link" :class="{active: activeTab('brands')}" @click="showTab('brands')">
                                    <i class="material-icons">folder_open</i> Brands
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
                <div v-if="activeTab('details')">details</div>
                <div v-if="activeTab('insights')">insights</div>
                <div v-if="activeTab('products')">products</div>
                <div v-if="activeTab('categories')">categories</div>
                <div v-if="activeTab('sub-categories')">sub categories</div>
                <div v-if="activeTab('brands')">brands</div>
                <div v-if="activeTab('orders')">orders</div>
                <div v-if="activeTab('payments')">payments</div>
                <div v-if="activeTab('wallet')">wallet</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShopAdmin",
        data() {
            return {
                tab: 'details',
                loadedShop: null,
                loaded: false
            }
        },
        created () {
            this.loadShop();
        },
        props: {
            shop: {
                type: String,
                required: true
            }
        },
        computed: {
            shopsRoute() {
                return "/admin/shops";
            }
        },
        methods: {
            transitionBack() {
                this.$router.push(this.shopsRoute);
            },
            showTab(tab) {
                this.tab = tab;
            },
            activeTab(tab) {
                return this.tab === tab;
            },
            loadShop() {
                this.loaded = false;
                this.loadedShop = null;
                axios.post(graphql.api, {
                    query: graphql.shopByCode,
                    variables: {shop: this.shop}
                }).then(this.loadShopDetails).catch(function (error) {});
            },
            loadShopDetails(response) {
                this.loaded = true;
                this.loadedShop = response.data.data.shop;
                this.showTab('details');
            }
        },
        watch: {
            '$route': 'loadShop'
        }
    }
</script>

<style scoped>

</style>