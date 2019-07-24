<template>
    <div>
        <div class="chat-line">
            <span class="chat-date">{{ date }}</span>
        </div>
        <template v-for="(chat, indx) in group">
            <chat-right :chat="chat" v-if="mine(chat)" :key="indx + '_right'"></chat-right>
            <chat-left :chat="chat" v-else :key="indx + '_right'"></chat-left>
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
                type: Array,
                required: true
            }
        },
        computed: {
            date() {
                if (Moment().isSame(Moment(this.group[0].created_at), 'd'))
                    return 'Today';

                if (Moment().subtract(1, 'days').isSame(Moment(this.group[0].created_at), 'd'))
                    return 'Yesterday';

                return Moment(this.group[0].created_at).format("MMMM Do, YYYY");
            },
        },
        methods: {
            mine(chat) {
                return _.lowerCase(this.participant) !== _.lowerCase(chat.sender.code);
            }
        }
    }
</script>

<style scoped>

</style>