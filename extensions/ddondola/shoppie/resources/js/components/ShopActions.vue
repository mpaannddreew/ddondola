<template>
    <div class="btn-group d-table ml-auto" role="group" aria-label="Table row actions">
        <a href="javascript:void(0)" @click="performAction" class="btn btn-pill btn-outline-primary active" :class="{ disabled: loading }">
            <i class="material-icons">thumb_up</i> {{ text }}
        </a>
        <a :href="messageUrl" class="btn btn-pill btn-outline-primary">
            <i class="material-icons">message</i> Message
        </a>
    </div>
</template>

<script>
    export default {
        name: "ShopActions",
        mounted() {
            this.getCurrentState();
        },
        data() {
            return {
                like: false,
                loaded: false,
                loading: false
            }
        },
        props: {
            shop: {
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
                    query: graphql.iLikeShop,
                    variables: {id: this.shop.id}
                }).then(this.loadAction).catch(function (error) {})
            },
            action() {
                this.loading = true;
                axios.post(graphql.api, {
                    query: graphql.likeShop,
                    variables: {id: this.shop.id}
                }).then(this.loadAction).catch(function (error) {})
            },
            loadAction(response) {
                this.like = response.data.data.like;
                this.loaded = true;
                this.loading = false;
            }
        },
        computed: {
            messageUrl() {
                return this.myMessengerUrl + "/" + this.shop.code
            },
            text() {
                return this.like ? 'Unlike': 'Like';
            }
        }
    }
</script>

<style scoped>

</style>