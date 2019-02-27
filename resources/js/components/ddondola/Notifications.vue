<template>
    <div class="card card-small user-activity mb-4 border">
        <div class="card-body p-0">
            <div is="notification" v-for="(indx, notification) in notifications" :key="indx"></div>
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