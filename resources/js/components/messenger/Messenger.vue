<template>
    <div class="messenger">
        <div class="messenger-content" style="margin: 0;">
            <chat-list :home-url="homeUrl"></chat-list>
            <chat-area></chat-area>
            <chat-profile></chat-profile>
        </div>
    </div>
</template>

<script>
    import ChatList from "./ChatList";
    import ChatArea from "./ChatArea";
    import ChatProfile from "./ChatProfile";
    export default {
        name: "Messenger",
        components: {ChatProfile, ChatArea, ChatList},
        mounted() {
            this.initScroll();
        },
        data() {
            return {
                chatList: '.messenger .chat-list .card .card-body',
                chatArea: '.messenger .chat-area .card .card-body',
                chatProfile: '.messenger .chat-profile .card .card-body',
            }
        },
        props: {
            homeUrl: {
                type: String,
                require: true
            }
        },
        computed: {
            scrollHost() {
                return this.chatList + ", " + this.chatArea + ", " + this.chatProfile;
            }
        },
        methods: {
            initScroll() {
                $(this.scrollHost).slimScroll({height: "100%"});
            }
        }
    }
</script>

<style scoped>

</style>