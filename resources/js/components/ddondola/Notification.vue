<template>
    <div class="user-activity__item pr-3 py-3">
        <div class="user-activity__item__icon">
            <i class="material-icons"></i>
        </div>
        <div class="user-activity__item__content">
            <span class="text-light">23 Minutes ago</span>
            <p>Assigned himself to the <a href="#">Shards Dashboards</a> project.</p>
        </div>
        <div class="user-activity__item__action ml-auto">
            <button class="ml-auto btn btn-sm btn-link"><i class="material-icons">radio_button_checked</i></button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Notification",
        data() {
            return {

            }
        },
        props: {
            notification: {
                type: Object,
                required: true
            }
        },
        computed: {
            icon() {

            }
        }
    }
</script>

<style scoped>

</style>