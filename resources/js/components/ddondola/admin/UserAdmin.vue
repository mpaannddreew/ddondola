<template>
    <div class="directory-area">
        <div class="card card-small main">
            <div class="card-body h-100" v-if="!showUser">
                <div class="center-xy">
                    <div align="center">
                        <div class="loader"></div>
                        <p class="m-0">Loading user...</p>
                    </div>
                </div>
            </div>
            <div class="card-body h-100 p-2" v-else>
                <div class="card card-small user-details border-right border-left">
                    <div class="card-header p-0" style="border-radius: 0 !important;">
                        <div class="user-details__bg">
                            <img :src="selectedUser.coverPicture.url" alt="User Details Background Image">
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="user-details__avatar mx-auto">
                            <img :src="selectedUser.avatar.url" alt="User Avatar">
                        </div>
                        <h4 class="text-center m-0 mt-2">{{ selectedUser.name }}</h4>
                        <p class="text-center text-light m-0 mb-2">{{ selectedUser.email }}</p>
                        <div class="user-details__user-data p-0">
                            <div class="header-navbar collapse d-lg-flex p-0 border-top border-bottom bg-light sticky">
                                <div class="container p-0">
                                    <ul class="nav nav-tabs nav-justified border-0 flex-column flex-lg-row">
                                        <li class="nav-item">
                                            <a href="javascript:void(0)" class="nav-link" :class="{active: activeTab('shops')}" @click="showTab('shops')">
                                                <i class="material-icons">shop_two</i> Shops
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
                    <div v-if="activeTab('shops')">
                        <user-shops :user="user" :admin="true"></user-shops>
                    </div>
                    <div v-if="activeTab('followers')">
                        <followers :user="selectedUser" :admin="true" :auth="false"></followers>
                    </div>
                    <div v-if="activeTab('following')">
                        <following :user="selectedUser" :admin="true" :auth="false"></following>
                    </div>
                    <div v-if="activeTab('payments')">payments</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserAdmin",
        data() {
            return {
                tab: 'shops',
                selectedUser: null,
                loaded: false
            }
        },
        created () {
            this.fetchUser();
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
            },
            showUser() {
                return this.loaded && this.selectedUser;
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
            fetchUser() {
                this.loaded = false;
                this.selectedUser = null;
                axios.post(graphql.api, {
                    query: graphql.userByCode,
                    variables: {user: this.user}
                }).then(this.loadUser).catch(function (error) {});
            },
            loadUser(response) {
                this.loaded = true;
                this.selectedUser = response.data.data.user;
                this.showTab('shops');
            }
        },
        watch: {
            '$route': 'fetchUser',
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
        border-radius: 5px;
    }
</style>