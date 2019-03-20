<template>
    <div class="friend-card border">
        <img src="/images/hero_in_shop_detail.jpg" alt="profile-cover" class="img-responsive cover">
        <div class="card card-info pb-3">
            <img src="/images/avatars/0.jpg" alt="user" class="profile-photo-lg">
            <div class="friend-info">
                <button v-if="!isMe" class="pull-right btn btn-sm btn-pill btn-outline-primary" @click="performAction" :class="{ active: follow, disabled: loading }">
                    <i class="material-icons mr-1">person_add</i> {{ text }}
                </button>
                <h5><a :href="userUrl" class="profile-link">{{ name }}</a></h5>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserCard",
        mounted() {
            this.getCurrentState();
        },
        data() {
            return {
                follow: false,
                loaded: false,
                loading: false
            }
        },
        props: {
            user: {
                type: Object,
                required: true
            },
            url: {
                type: String,
                required: true
            },
            isMe: {
                type: Boolean,
                required: false,
                default: false
            }
        },
        methods: {
            performAction() {
                if (this.loaded) {
                    this.action();
                }
            },
            getCurrentState() {
                this.loading = true;
                axios.post(graphql.api, {
                    query: graphql.iFollowUser,
                    variables: {id: this.user.id}
                }).then(this.loadAction).catch(function (error) {})
            },
            action() {
                this.loading = true;
                axios.post(graphql.api, {
                    query: graphql.followUser,
                    variables: {id: this.user.id}
                }).then(this.loadAction).catch(function (error) {})
            },
            loadAction(response) {
                this.follow = response.data.data.follow;
                this.loaded = true;
                this.loading = false;
            }
        },
        computed: {
            userUrl() {
                return this.url + "/people/" + this.user.code
            },
            text() {
                return this.follow ? 'Unfollow': 'Follow';
            },
            name() {
                return this.isMe ? this.user.name + " (Me)": this.user.name;
            }
        }
    }
</script>

<style scoped>

</style>