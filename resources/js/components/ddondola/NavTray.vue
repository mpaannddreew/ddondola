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
        data() {
            return {
                unReadCount: 4,
                trayUrl: '/me/notifications'
            }
        },
        computed: {
            icon() {
                return this.unReadCount > 0 ? 'notifications_active' : 'notifications_none'
            },
            showUnReadCount() {
                return this.unReadCount > 0;
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