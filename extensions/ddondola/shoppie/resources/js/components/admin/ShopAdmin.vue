<template>
    <div class="directory-area">
        <div class="card card-small main">
            <div class="card-body h-100" v-if="!showShop">
                <div class="center-xy">
                    <div align="center">
                        <div class="loader"></div>
                        <p class="m-0">Loading shop...</p>
                    </div>
                </div>
            </div>
            <div class="card-body h-100 p-2" v-else>
                <div class="card card-small user-details border-right border-left">
                    <div class="card-header p-0" style="border-radius: 0 !important;">
                        <div class="user-details__bg">
                            <img :src="selectedShop.coverPicture.url" alt="User Details Background Image">
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="user-details__avatar mx-auto">
                            <img :src="selectedShop.avatar.url" alt="User Avatar">
                        </div>
                        <h4 class="text-center m-0 mt-2">{{ selectedShop.name }}</h4>
                        <p class="text-center text-light m-0 mb-2">{{ selectedShop.profile.email }}</p>
                        <div class="user-details__user-data p-0">
                            <div class="header-navbar collapse d-lg-flex p-0 bg-light border-top border-bottom sticky">
                                <div class="container p-0">
                                    <ul class="nav nav-tabs nav-justified border-0 flex-column flex-lg-row">
                                        <li class="nav-item">
                                            <a href="javascript:void(0)" class="nav-link" :class="{active: activeTab('insights')}" @click="showTab('insights')">
                                                <i class="material-icons">show_chart</i> Insights
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0)" class="nav-link" :class="{active: activeTab('inventory')}" @click="showTab('inventory')">
                                                <i class="material-icons">local_mall</i> Inventory
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0)" class="nav-link" :class="{active: activeTab('payments')}" @click="showTab('payments')">
                                                <i class="material-icons">credit_card</i> Payments
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-2">
                    <div v-if="activeTab('insights')">insights</div>
                    <div v-if="activeTab('inventory')">
                        <shop-inventory :shop="shop" :admin="true"></shop-inventory>
                    </div>
                    <div v-if="activeTab('payments')">payments</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ShopInventory from "../ShopInventory";
    export default {
        name: "ShopAdmin",
        components: {ShopInventory},
        data() {
            return {
                tab: 'insights',
                loaded: false,
                selectedShop: null
            }
        },
        created () {
            this.fetchShop();
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
            },
            showShop() {
                return this.loaded && this.selectedShop;
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
            fetchShop() {
                this.loaded = false;
                this.selectedShop = null;
                axios.post(graphql.api, {
                    query: graphql.shopByCode,
                    variables: {shop: this.shop}
                }).then(this.loadShop).catch(function (error) {});
            },
            loadShop(response) {
                this.loaded = true;
                this.selectedShop = response.data.data.shop;
                this.showTab('insights');
            }
        },
        watch: {
            '$route': 'fetchShop'
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

    .user-details__avatar {
        box-shadow: none !important;
        border: medium solid #ffffff;
    }
</style>