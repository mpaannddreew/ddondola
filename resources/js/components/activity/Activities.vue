<template>
    <div>
        <div class="card card-small border">
            <div class="card-header border-bottom">
                <h5 class="m-0"><img src="/images/feed.png" alt="" style="filter: grayscale(100%);"> {{ title }}</h5>
            </div>
            <div class="card-body p-0">
                <activity></activity>
                <activity></activity>
                <activity></activity>
            </div>
        </div>
        <a href="javascript:void(0)" class="btn-view btn-load-more border"></a>
    </div>
</template>

<script>
    import Activity from "./Activity";
    export default {
        name: "Activities",
        components: {Activity},
        mounted() {

        },
        data() {
            return {}
        },
        props: {
            title: {
                type: String,
                default: "Timeline"
            }
        }
    }
</script>

<style scoped>

</style>