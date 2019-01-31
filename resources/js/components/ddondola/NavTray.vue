<template>
    <li class="nav-item border-right dropdown notifications border-radius">
        <a class="nav-link nav-link-icon text-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="nav-link-icon__wrapper">
                <i class="material-icons">{{ icon }}</i>
                <span class="badge badge-pill badge-danger" v-show="showUnReadCount">{{ unReadCount }}</span>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="#">
                <div class="notification__icon-wrapper">
                    <div class="notification__icon">
                        <i class="material-icons">&#xE6E1;</i>
                    </div>
                </div>
                <div class="notification__content">
                    <span class="notification__category">Analytics</span>
                    <p>Your website’s active users count increased by <span class="text-success text-semibold">28%</span> in the last week. Great job!</p>
                </div>
            </a>
            <a class="dropdown-item" href="#">
                <div class="notification__icon-wrapper">
                    <div class="notification__icon">
                        <i class="material-icons">&#xE8D1;</i>
                    </div>
                </div>
                <div class="notification__content">
                    <span class="notification__category">Sales</span>
                    <p>Last week your store’s sales count decreased by <span class="text-danger text-semibold">5.52%</span>. It could have been worse!</p>
                </div>
            </a>
            <a class="dropdown-item notification__all text-center" :href="trayUrl"> See all notifications </a>
        </div>
    </li>
</template>

<script>
    export default {
        name: "NavTray",
        data() {
            return {
                notifications: [],
                unReadCount: 0,
                trayUrl: '/notifications'
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