<template>
    <div>
        <div class="card card-small mb-1 border" style="border-bottom: none !important;">
            <div class="card-header px-2 border-bottom">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-left mb-sm-0">
                        <h5 class="m-0"><i class="material-icons">notifications</i> All Notifications</h5>
                    </div>
                    <div class="col-12 col-sm-6 d-flex align-items-center">
                        <ul class="ml-auto mb-0" style="list-style: none;">
                            <li class="dropdown dropdown-action dropdown-menu-sm-left">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-small" style="display: none;">
                                    <a class="dropdown-item" href="javascript:void(0)"><i class="material-icons">notifications_none</i> Mark all as read</a>
                                    <a class="dropdown-item" href="javascript:void(0)"><i class="material-icons">notifications_active</i> Mark all as unread</a>
                                    <a class="dropdown-item" href="javascript:void(0)"><i class="material-icons">delete_forever</i> Delete all</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="activity">
                    <div class="activity-box">
                        <ul class="activity-list">
                            <template v-for="(indx, notification) in notifications">
                                <li class="m-0" is="notification" :key="indx"></li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <a href="javascript:void(0)" class="btn-view btn-load-more border"></a>
    </div>
</template>

<script>
    import Notification from "./Notification";
    export default {
        name: "Notifications",
        components: {Notification},
        data() {
            return {
                notifications: [1, 2, 3, 4]
            }
        }
    }
</script>

<style scoped>

</style>