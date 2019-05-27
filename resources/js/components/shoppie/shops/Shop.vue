<template>
    <div class="friend-card border mb-0">
        <img :src="shop.coverPicture.url" alt="profile-cover" class="img-responsive cover">
        <div class="card card-info pb-3">
            <img :src="shop.avatar.url" alt="user" class="profile-photo-lg">
            <div class="friend-info">
                <button class="pull-right btn btn-sm btn-pill btn-outline-primary" @click="performAction" :class="{ active: like, disabled: loading }" v-if="auth">
                    <i class="material-icons mr-1">thumb_up</i> {{ text }}
                </button>
                <h5><a :href="shopUrl" class="profile-link">{{ shop.name }} <i class="fa fa-check-circle" aria-hidden="true" v-if="verified"></i></a></h5>
                <p class="m-0">{{ shop.category.name }} | {{ likes }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Shop",
        mounted() {
            this.getCurrentState();
        },
        data() {
            return {
                verified: false,
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
            auth: {
                type: Boolean,
                required: false,
                default: true
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
                        query: graphql.iLikeShop,
                        variables: {id: this.shop.id}
                    }).then(this.loadAction).catch(function (error) {});
                }
            },
            action() {
                this.loading = true;
                axios.post(graphql.api, {
                    query: graphql.likeShop,
                    variables: {id: this.shop.id}
                }).then(this.loadAction).catch(function (error) {});
            },
            loadAction(response) {
                this.like = response.data.data.like;
                this.loaded = true;
                this.loading = false;
            }
        },
        computed: {
            shopUrl() {
                return "/shops/" + this.shop.code;
            },
            text() {
                return this.like ? 'Unlike': 'Like';
            },
            likes() {
                return this.shop.likes + (this.shop.likes === 1 ? " Like": " Likes");
            }
        }
    }
</script>

<style scoped>

</style>