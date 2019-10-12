<template>
    <div class="card card-small user-details" :class="{ border: withBorder }">
        <div class="card-header p-0" style="border-radius: 0 !important;">
            <div class="user-details__bg">
                <img :src="user.coverPicture.url" :alt="user.name">
            </div>
        </div>
        <div class="card-body p-0 border-0">
            <div class="user-details__avatar mx-auto border lis-border-width-4" style="box-shadow: none !important; border-radius: 5px !important; border: medium solid rgb(255, 255, 255) !important;">
                <img :src="user.avatar.url" alt="User Avatar">
            </div>
            <h4 class="text-center m-0 mt-2">
                <a :href="url" class="btn-link">
                    {{ user.name }}
                </a>
            </h4>
            <p class="text-center text-light m-0 mb-2">
                <small class="text-muted" v-if="!withBorder">
                    {{ user.followerCount }} Follower(s) | {{ user.followingCount }} Following
                </small>
                <small class="text-muted" v-else>
                    {{ user.email }}
                </small>
                <slot></slot>
            </p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item p-4" v-for="(p, i) in user.profile" v-if="p">
                <strong class="text-muted d-block mb-2">{{ i|camel|ucFirst }}</strong>
                <span>
                    {{ p }}
                </span>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "UserInformation",
        props: {
            user: {
                type: Object,
                required: true
            },
            withBorder: {
                type: Boolean,
                default: false
            }
        },
        computed: {
            url() {
                return `/people/${this.user.code}`;
            }
        }
    }
</script>

<style scoped>
    li.list-group-item.p-4:first-child {
        border-top: none !important;
    }
</style>