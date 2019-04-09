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
        name: "Feed",
        components: {Activity},
        mounted() {

        },
        data() {
            return {}
        },
        props: {
            actor: {
                type: Object,
                required: false
            },
            actorType: {
                type: String,
                default: 'user'
            },
            feedType: {
                type: String,
                default: 'timeline'
            }
        },
        computed: {
            title() {
                return this.feedType === 'timeline' ? 'Timeline': 'News Feed';
            }
        }
    }
</script>

<style scoped>

</style>