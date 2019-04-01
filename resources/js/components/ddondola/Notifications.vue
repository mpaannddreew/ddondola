<template>
    <div class="card card-small user-activity mb-4 border">
        <div class="card-header border-bottom">
            <h5 class="m-0"><i class="material-icons">notifications</i> All Notifications</h5>
        </div>
        <div class="card-body">
            <div class="notification-box">
                <ul class="m-0">
                    <template v-for="(indx, notification) in notifications">
                        <li class="" is="notification" :key="indx"></li>
                    </template>
                </ul>
            </div>
        </div>
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