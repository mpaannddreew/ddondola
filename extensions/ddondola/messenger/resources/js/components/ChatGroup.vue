<template>
    <div>
        <div class="chat-line">
            <span class="chat-date border px-2 py-1 border-radius bg-white text-primary">{{ group.date|day }}</span>
        </div>
        <template v-for="(chat, indx) in group.chats">
            <chat-right :chat="chat" v-if="mine(chat)" :key="indx + '_right'"></chat-right>
            <chat-left :chat="chat" v-else :key="indx + '_left'"></chat-left>
        </template>
    </div>
</template>

<script>
    import ChatLeft from "./ChatLeft";
    import ChatRight from "./ChatRight";
    export default {
        name: "ChatGroup",
        components: {ChatRight, ChatLeft},
        mounted() {},
        data() {
            return {

            }
        },
        props: {
            participant: {
                type: String,
                required: true
            },
            initiator: {
                type: String
            },
            group: {
                type: Object,
                required: true
            }
        },
        methods: {
            mine(chat) {
                return this.lowerCase(this.participant) !== this.lowerCase(chat.sender.code);
            }
        }
    }
</script>

<style scoped>

</style>