<template>
    <li class="nav-item border-right dropdown notifications">
        <a class="nav-link nav-link-icon text-center" :href="homeUrl" role="button">
            <div class="nav-link-icon__wrapper">
                <i class="material-icons">{{ icon }}</i>
                <span class="badge badge-pill badge-danger" v-show="showUnReadCount">{{ unReadCount }}</span>
            </div>
        </a>
    </li>
</template>

<script>

    export default {
        name: "NavMessenger",
        mounted() {
            this.fetchUnreadSize();
            this.listenToMessengerEvents();
        },
        data() {
            return {
                unReadCount: 0
            }
        },
        props: {
            homeUrl: {
                type: String,
                require: true
            }
        },
        computed: {
            showUnReadCount() {
                return this.unReadCount > 0;
            },
            icon() {
                return 'chat_bubble';
            }
        },
        methods: {
            fetchUnreadSize() {
                axios.post(graphql.api, {query: graphql.unreadMessageCount})
                    .then(this.loadUnreadMessageCount).catch(function (error) {});
            },
            loadUnreadMessageCount(response) {
                this.unReadCount = response.data.data.me.unreadMessageCount;
            },
            listenToMessengerEvents() {
                Bus.$on('unread-messages', (count) => {
                    this.unReadCount += count;
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