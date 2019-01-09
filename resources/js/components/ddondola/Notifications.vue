<template>
    <div class="activity">
        <div class="activity-box">
            <ul class="activity-list">
                <li is="notification" v-for="(notification, indx) in notifications"></li>
            </ul>
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
                notifications: [1]
            }
        }
    }
</script>

<style scoped>

</style>