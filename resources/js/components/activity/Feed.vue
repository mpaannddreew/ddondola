<template>
    <div>
        <div class="card card-small border">
            <div class="card-header border-bottom">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-left mb-sm-0">
                        <h5 class="m-0"><img src="/images/feed.png" alt="" style="filter: grayscale(100%);"> {{ title }}</h5>
                    </div>
                    <div class="col-12 col-sm-6 d-flex align-items-center">
                        <div class="ml-auto">
                            <select class="form-control custom-select custom-select-sm" tabindex="-98" v-model="ordering">
                                <option value="latest">Latest</option>
                                <option value="oldest">Oldest</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <template v-if="!loaded">
                    <div align="center" class="p-4"><div class="loader"></div></div>
                </template>
                <template v-else-if="!hasActivities && loaded">
                    <div align="center" class="p-4">
                        <h4>
                            <i class="material-icons">error_outline</i>
                            <br />
                            <small>No activity yet</small>
                        </h4>
                    </div>
                </template>
                <activity v-else-if="hasActivities && loaded" v-for="(activity, indx) in activities" :activity="activity" :key="indx"></activity>
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
            this.fetchActivities();
        },
        data() {
            return {
                ordering: 'latest',
                activities: [],
                paginatorInfo: null,
                loaded: false,
                loadingMore: false,
                count: 0
            }
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
            },
            hasActivities() {
                return this.activities.length > 0;
            },
            variables() {
                var variables = {count: this.count, page: 1, ordering: this.ordering};
                if (this.actor && (this.actorType === 'user'|| this.actorType === 'shop')) {
                    variables["id"] = this.actor.id;
                }

                return variables;
            },
            query() {
                if (this.actor && this.actorType === 'user') {
                    return graphql.userTimeline;
                } else if(this.actor && this.actorType === 'shop') {
                    return graphql.shopTimeline;
                }else if(!this.actor && this.actorType === 'user' && this.feedType === 'timeline') {
                    return graphql.myTimeline;
                } else {
                    return graphql.myNews;
                }
            },
            loaderDisabled() {
                if (this.paginatorInfo) {
                    return !this.paginatorInfo.hasMorePages;
                }

                return true;
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
                if (this.actor && this.actorType === 'user') {
                    this.activities = response.data.data.user.timeline.data;
                    this.paginatorInfo = response.data.data.user.timeline.paginatorInfo;
                } else if(this.actor && this.actorType === 'shop') {
                    this.activities = response.data.data.shop.timeline.data;
                    this.paginatorInfo = response.data.data.shop.timeline.paginatorInfo;
                }else if(!this.actor && this.actorType === 'user' && this.feedType === 'timeline') {
                    this.activities = response.data.data.me.timeline.data;
                    this.paginatorInfo = response.data.data.me.timeline.paginatorInfo;
                } else {
                    this.activities = response.data.data.me.news.data;
                    this.paginatorInfo = response.data.data.me.news.paginatorInfo;
                }
            },
            loadMore() {
                this.loadingMore = true;
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