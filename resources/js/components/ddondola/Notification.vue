<template>
    <div class="user-activity__item pr-3 py-3">
        <div class="user-activity__item__icon">
            <img src="/images/avatars/0.jpg" alt="User Avatar" class="user-avatar rounded-circle mr-2 w-100">
        </div>
        <div class="user-activity__item__content">
            <span class="text-light">23 Minutes ago</span>
            <p>Assigned himself to the <a href="#">Shards Dashboards</a> project.</p>
        </div>
        <div class="user-activity__item__action ml-auto">
            <button class="ml-auto btn btn-sm btn-white">View Project</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Notification",
        data() {
            return {

            }
        }
    }
</script>

<style scoped>

</style>