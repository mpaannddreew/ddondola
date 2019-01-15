<template>
    <div>
        <div class="tab-feed mb-4">
            <ul class="m-0">
                <li data-tab="feed-dd" :class="{active: active}" @click="feedTab">
                    <a title="">
                        <img src="/images/tabs/ic1.png" alt="">
                        <span>Activity</span>
                    </a>
                </li>
            </ul>
        </div>
        <activity-tab :class="{current: current}"></activity-tab>
    </div>
</template>

<script>
    import ActivityTab from "./ActivityTab";
    export default {
        name: "ProfileTabs",
        components: {ActivityTab},
        data() {
            return {
                active: true,
                current: true
            }
        },
        methods: {
            feedTab() {
                this.active = true;
                this.current = true;
            }
        }
    }
</script>

<style scoped>

</style>