<template>
    <div>
        <div class="card card-small border">
            <div class="card-body p-0">
                <template v-if="!loaded || (!hasActivities && loaded)">
                    <div align="center" class="p-3" v-if="!loaded">
                        <div class="loader"></div>
                        <p class="m-0">Loading ...</p>
                    </div>
                    <div align="center" class="p-3" v-if="!hasActivities && loaded">
                        <h4 class="m-0"><i class="material-icons">error</i></h4>
                        <p class="m-0">{{ noActivityMessage }}</p>
                    </div>
                </template>
                <template v-else>
                    <activity v-for="(activity, indx) in activities" :activity="activity" :key="indx"></activity>
                </template>
            </div>
        </div>
        <template v-if="loadingMore">
            <div align="center" class="p-4"><div class="loader"></div></div>
        </template>
        <a href="javascript:void(0)" v-if="!loadingMore && loaded" @click="loadMore" class="btn-view btn-load-more border" :class="{disabled: loaderDisabled}"></a>
    </div>
</template>

<script>
    import Activity from "./Activity";
    export default {
        name: "Feed",
        components: {Activity},
        mounted() {
            this.initialCount();
            this.loadMore(false);
        },
        data() {
            return {
                activities: [],
                paginatorInfo: null,
                loaded: false,
                loadingMore: false,
                count: 0
            }
        },
        props: {
            admin: {
                type: Boolean,
                default: false
            },
            user: {
                type: Object,
                required: false
            }
        },
        computed: {
            hasActivities() {
                return this.activities.length > 0;
            },
            loaderDisabled() {
                if (this.paginatorInfo) {
                    return !this.paginatorInfo.hasMorePages;
                }

                return true;
            },
            noActivityMessage() {
                if (this.admin)
                    return 'It looks like you have no activity. Follow other people or make reviews to start building your activity pool.';

                return 'This user has no activity yet.';
            },
            query() {
                if (this.admin) {
                    return graphql.myActivity;
                }

                return graphql.userActivity;
            },
            variables() {
                var variables = {count: this.count, page: 1};
                if(!this.admin) {
                    variables["id"] = this.user.id;
                }

                return variables;
            }
        },
        methods: {
            initialCount() {
                this.count = graphql.rowCount;
            },
            fetchActivities() {
                axios.post(graphql.api, {
                    query: this.query,
                    variables: this.variables
                }).then(this.loadActivities).catch(function (error) {});
            },
            loadActivities(response) {
                this.loaded = true;
                this.loadingMore = false;
                if (this.admin) {
                    this.activities = response.data.data.me.activity.data;
                    this.paginatorInfo = response.data.data.me.activity.paginatorInfo;
                }else {
                    this.activities = response.data.data.user.activity.data;
                    this.paginatorInfo = response.data.data.user.activity.paginatorInfo;
                }
            },
            loadMore(indicator=true) {
                this.loadingMore = indicator;
                this.count += graphql.rowCount;
                this.fetchActivities();
            }
        },
        watch: {
            ordering(data) {
                this.loaded = false;
                this.activities = [];
                this.initialCount();
                this.fetchActivities();
            }
        }
    }
</script>

<style scoped>

</style>