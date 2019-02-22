<template>
    <div class="chat-list close-chat-list" id="chat_list">
        <div class="card card-small h-100 border-right" style="border-radius: 0; box-shadow: none;">
            <div class="card-header border-bottom">
                <form action="#" class="main-navbar__search w-100 d-md-flex d-lg-flex">
                    <div class="input-group input-group-seamless">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="material-icons ">search</i>
                            </div>
                        </div>
                        <input class="navbar-search form-control" type="text" placeholder="Search Conversations"
                               aria-label="Search" style="margin: 0">
                    </div>
                </form>
            </div>
            <div class="card-body d-flex flex-column">
                <ul class="contact-list">
                    <li is="chat-user" v-for="(chatUser, indx) in chatUsers" :key="indx" :home-url="homeUrl"></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import ChatUser from "./ChatUser";
    export default {
        name: "ChatList",
        components: {ChatUser},
        data() {
            return {
                chatUsers: [1, 2, 3, 4, 5]
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