<template>
    <div>
        <div class="card card-small mb-1 border" style="border-bottom: none !important;">
            <div class="card-body p-0" :class="{'border-bottom': !hasNotifications}">
                <div align="center" v-if="!loaded" class="p-4">
                    <div class="loader"></div>
                    <p class="m-0">Loading notifications...</p>
                </div>
                <div align="center" v-if="!hasNotifications && loaded" class="p-4">
                    <h4 class="m-0"><i class="material-icons">notifications_active</i></h4>
                    <p class="m-0">You have not received any notifications yet!</p>
                </div>
                <div class="activity" v-if="hasNotifications && loaded">
                    <div class="activity-box">
                        <ul class="activity-list">
                            <template v-for="(notification, indx) in notifications">
                                <li class="m-0" is="notification" :key="indx" :notification="notification"></li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <pagination v-if="paginatorInfo" class="my-4" :paginator-info="paginatorInfo" v-on:page="loadPage"></pagination>
    </div>
</template>

<script>
    import Notification from "./Notification";
    export default {
        name: "Notifications",
        components: {Notification},
        mounted() {
            this.fetchNotifications();
        },
        data() {
            return {
                notifications: [],
                page: 1,
                loaded: false,
                paginatorInfo: null
            }
        },
        computed: {
            hasNotifications() {
                return this.notifications.length > 0;
            }
        },
        methods: {
            fetchNotifications() {
                this.loaded = false;
                this.notifications = [];
                axios.post(graphql.api, {
                    query: graphql.myNotifications,
                    variables: {count: graphql.rowCount, page: this.page}
                }).then(this.loadNotifications).catch(function (error) {});
            },
            loadNotifications(response) {
                console.log(JSON.stringify(response.data));
                this.loaded = true;
                this.notifications = response.data.data.me.notifications.data;
                this.paginatorInfo = response.data.data.me.notifications.paginatorInfo;
            },
            loadPage(page) {
                this.page = page;
                this.fetchNotifications();
            }
        }
    }
</script>

<style scoped>

</style>