<template>
    <div class="chat-list close-chat-list" id="chat_list">
        <all-contacts v-if="!ownRepositoryActive" :home-url="homeUrl" :owner-id="ownerId" :owner-type="ownerType"></all-contacts>
        <div class="card card-small h-100 border-right main" style="border-radius: 0; box-shadow: none;" v-if="ownRepositoryActive">
            <div class="card-header border-bottom bg-light">
                <div class="row bg-light m-0">
                    <div class="col-12 p-0" :class="{'col-sm-10': conversationsActive, 'col-sm-12': !conversationsActive}">
                        <div class="input-group input-group-seamless">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="material-icons ">search</i>
                                </div>
                            </div>
                            <input class="navbar-search form-control pr-5" type="text" :placeholder="placeholder" style="margin: 0" v-model="filter">
                        </div>
                    </div>
                    <div class="col-12 col-sm-2 d-flex mb-2 mb-sm-0 p-0" v-if="conversationsActive">
                        <a href="javascript:void(0)" class="btn btn-sm btn-success ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" @click="showPlatformRepository"><i class="material-icons">add</i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="header-navbar collapse d-lg-flex p-0 bg-light border-bottom">
                    <div class="container p-0">
                        <div class="row">
                            <div class="col">
                                <ul class="nav nav-tabs nav-justified border-0 flex-column flex-lg-row">
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" class="nav-link" :class="{active: conversationsActive}" @click="showConversations"><i class="material-icons">chat</i> Conversations</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" class="nav-link" :class="{active: !conversationsActive}" @click="showContacts"><i class="material-icons">contacts</i> Contacts</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <conversations v-if="conversationsActive" :home-url="homeUrl" :owner-id="ownerId" :owner-type="ownerType"></conversations>
                <contacts v-else :home-url="homeUrl" :owner-id="ownerId" :owner-type="ownerType"></contacts>
            </div>
        </div>
    </div>
</template>

<script>
    import Conversations from "./Conversations";
    import Contacts from "./Contacts";
    import AllContacts from "./AllContacts";
    export default {
        name: "ChatList",
        components: {AllContacts, Conversations, Contacts},
        mounted() {
            this.listen();
        },
        data() {
            return {
                ownRepositoryActive: true,
                conversationsActive: true,
                filter: ''
            }
        },
        props: {
            homeUrl: {
                type: String,
                require: true
            },
            ownerId: {
                required: true
            },
            ownerType: {
                type: String,
                required: true
            }
        },
        computed: {
            placeholder() {
                return this.conversationsActive ? "Filter Conversations": "Filter Contacts";
            }
        },
        methods: {
            showConversations() {
                this.conversationsActive = true;
            },
            showContacts() {
                this.conversationsActive = false;
            },
            showOwnRepository() {
                this.ownRepositoryActive = true;
            },
            showPlatformRepository() {
                this.ownRepositoryActive = false;
            },
            listen() {
                Bus.$on("show-own-repository", this.showOwnRepository);
                Bus.$on("show-platform-repository", this.showPlatformRepository);
            }
        },
        watch: {
            conversationsActive(data) {
                this.filter = '';
            },
            filter(data) {
                Bus.$emit("filter", data);
            }
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
</style>