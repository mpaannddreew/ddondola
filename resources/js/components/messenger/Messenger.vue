<template>
    <div class="messenger">
        <div class="messenger-content" style="margin: 0;">
            <chat-list :home-url="homeUrl" :owner-id="ownerId" :owner-type="ownerType"></chat-list>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import ChatList from "./ChatList";
    export default {
        name: "Messenger",
        components: {ChatList},
        mounted() {

        },
        data() {
            return {

            }
        },
        props: {
            homeUrl: {
                type: String,
                require: true
            },
            ownerId: {
                required: true
            },
            ownerType: {
                type: String,
                required: true
            }
        },
        computed: {

        },
        methods: {

        }
    }
</script>

<style scoped>

</style>