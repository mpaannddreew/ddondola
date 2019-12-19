<template>
    <li class="nav-item border-right dropdown notifications border-radius">
        <a class="nav-link nav-link-icon text-center" :href="trayUrl">
            <div class="nav-link-icon__wrapper">
                <i class="material-icons">{{ icon }}</i>
                <span class="badge badge-pill badge-danger" v-show="showUnReadCount">{{ unReadCount }}</span>
            </div>
        </a>
    </li>
</template>

<script>
    export default {
        name: "NavTray",
        mounted() {
            this.fetchUnreadCount();
            this.listenForNotifications();
        },
        data() {
            return {
                unReadCount: 0
            }
        },
        computed: {
            icon() {
                return this.showUnReadCount ? 'notifications_active' : 'notifications';
            },
            showUnReadCount() {
                return this.unReadCount > 0;
            },
            trayUrl() {
                return '/me/notifications';
            }
        },
        methods: {
            fetchUnreadCount() {
                axios.post(graphql.api, {query: graphql.unreadNotificationCount})
                    .then((response) => {
                        this.unReadCount = response.data.data.me.unreadNotificationCount;
                    }).catch(function (error) {});
            },
            listenForNotifications() {
                Echo.private(`user.${this.authCode}`)
                    .notification((notification) => {
                        this.unReadCount++;
                    });
            }
        },
        watch: {
            unReadCount: {
                handler: function (unReadCount) {
                    if (unReadCount < 0) {
                        this.unReadCount = 0;
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>