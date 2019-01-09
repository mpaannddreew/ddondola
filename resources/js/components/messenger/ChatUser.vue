<template>
    <li>
        <router-link :to="homeUrl + 'code'">
            <div class="media">
                <span class="avatar align-self-center">
                    <img src="/images/avatars/0.jpg">
                </span>
                <div class="media-body align-self-center text-nowrap">
                    <div class="user-name cut-text">Jeffery Lalor</div>
                    <div class="designation cut-text">I am texting you to let you know that we finished</div>
                </div>
                <div class="text-nowrap align-self-center">
                    <div class="online-date">
                        <span class="badge badge-light">Yesterday</span>
                    </div>
                </div>
            </div>
        </router-link>
    </li>
</template>

<script>
    export default {
        name: "ChatUser",
        data() {
            return {

            }
        },
        props: {
            homeUrl: {
                type: String,
                require: true
            }
        }
    }
</script>

<style scoped>

</style>