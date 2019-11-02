<template>
    <tr>
        <td class="lo-stats__image" :class="{'border-top-0': isFirst}">
            <img class="border rounded" :src="user.avatar.url">
        </td>
        <td class="lo-stats__order-details" :class="{'border-top-0': isFirst}">
            <span>{{ user.name }}</span>
            <span>{{ user.email}}</span>
        </td>
        <td :class="{'border-top-0': isFirst && !admin}">
            <div class="btn-group d-table ml-auto" role="group" v-if="!isMe(user.code)">
                <a href="javascript:void(0)" class="btn btn-sm btn-white" title="" v-if="admin" @click="showProfile"><i class="material-icons">account_circle</i> Profile</a>
                <a :href="userUrl" class="btn btn-sm btn-white" title="" v-else><i class="material-icons">account_circle</i> Profile</a>
                <a v-if="auth && !admin"  href="javascript:void(0)" class="btn btn-sm btn-white" @click="performAction" :class="{ disabled: loading }">
                    <i class="material-icons">person_add</i> {{ text }}
                </a>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        name: "Person",
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
            indx: {
                type: Number
            },
            admin: {
                type: Boolean,
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
                if (this.auth) {
                    this.loading = true;
                    axios.post(graphql.api, {
                        query: graphql.iFollowUser,
                        variables: {id: this.user.id}
                    }).then(this.loadAction).catch(function (error) {});
                }
            },
            action() {
                this.loading = true;
                axios.post(graphql.api, {
                    query: graphql.followUser,
                    variables: {id: this.user.id}
                }).then(this.loadAction).catch(function (error) {});
            },
            loadAction(response) {
                this.follow = response.data.data.follow;
                this.loaded = true;
                this.loading = false;
            },
            showProfile() {
                this.$router.push(`/admin/users/${this.user.code}`);
            }
        },
        computed: {
            userUrl() {
                return `/people/${this.user.code}`;
            },
            text() {
                return this.follow ? 'Unfollow': 'Follow';
            },
            name() {
                return this.user.name;
            },
            followers() {
                return `${this.user.followerCount}${(this.user.followerCount === 1 ? " Follower": " Followers")}`;
            },
            following() {
                return `${this.user.followingCount}${(this.user.followingCount === 1 ? " Following": " Following")}`;
            },
            isFirst() {
                return this.indx === 0;
            }
        }
    }
</script>

<style scoped>
 td span {

 }
</style>