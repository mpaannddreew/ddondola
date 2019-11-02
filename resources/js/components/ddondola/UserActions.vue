<template>
    <div class="btn-group d-table mx-auto" role="group" aria-label="Table row actions">
        <a href="javascript:void(0)" @click="performAction" class="btn btn-outline-primary active" :class="{ disabled: loading }">
            <i class="material-icons">person_add</i> {{ text }}
        </a>
        <a :href="messageUrl" class="btn btn-outline-primary">
            <i class="material-icons">message</i> Message
        </a>
    </div>
</template>

<script>
    export default {
        name: "UserActions",
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
            myMessengerUrl: {
                type: String,
                required: true
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
            messageUrl() {
                return `${this.myMessengerUrl}/${this.user.code}`;
            },
            text() {
                return this.follow ? 'Unfollow': 'Follow';
            }
        }
    }
</script>

<style scoped>

</style>